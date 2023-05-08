<?php
require_once PROJECT_ROOT_PATH . "/model/Database.php";

class QuestionModel extends Database
{
    public function getQuestionForPlayer(int $player): array
    {
        $position = 1;
        $complete = false;
        $this->query("SELECT question FROM player_answers WHERE player = :id ORDER BY question DESC LIMIT 1");
        $this->bind(":id", $player);
        $question = $this->single();
        if($question !== false){
            $position = $question["question"] + 1;
        }

        $this->query("SELECT id, question, CC, sound FROM questions WHERE position = :p");
        $this->bind(":p", $position);
        $question_result = $this->single();
        if($position !== 1 && $question_result === false){
            $this->query("UPDATE player SET complete = 1 WHERE id = :id");
            $this->bind(":id", $player);
            $this->execute();
            return Array("question" => array("game_complete" => true), "answers" => Array());
        }
        $this->query("SELECT id, answer FROM questions_answers WHERE question = :q");
        $this->bind(":q", $question_result["id"]);
        $question_answers = $this->resultset();
        return Array("question" => $question_result, "answers" => $question_answers);

    }

    public function sendAnswerPlayer(int $player, int $answer)
    {
        $this->query("SELECT question, money_change, message FROM questions_answers WHERE id = :id");
        $this->bind(":id", $answer);
        $answerData = $this->single();
        if($answerData === false){
            return Array("message" => "Answer not found (id: $answer)");
        }
        $this->query("SELECT COUNT(*) AS answered FROM player_answers WHERE player = :u && question = :q");
        $this->bind(":u", $player);
        $this->bind(":q", $answerData["question"]);
        $answered = $this->single()["answered"];
        if($answered === "0") {
            $this->query("INSERT INTO player_answers (player, question, answer) VALUES (:u, :q, :a)");
            $this->bind(":u", $player);
            $this->bind(":q", $answerData["question"]);
            $this->bind(":a", $answer);
            $this->execute();

            $this->query("UPDATE player SET money = money + :m WHERE id = :id");
            $this->bind(":m", $answerData["money_change"]);
            $this->bind(":id", $player);
            $this->execute();

            $this->query("INSERT INTO player_answer_log (player, answer, question, money, message) VALUES (:player, :answer, :question, :money, :message)");
            $this->bind(":player", $player);
            $this->bind(":answer", $answer);
            $this->bind(":question", $answerData["question"]);
            $this->bind(":money", $answerData["money_change"]);
            $this->bind(":message", $answerData["message"]);
            $this->execute();
            $return = Array("money_change" => $answerData["money_change"], "message" => $answerData["message"]);
            return $return;
        }
        $return = Array("money_change" => 0, "message" => "Tato otázka již byla zodpovězena");
        return $return;

    }
}
