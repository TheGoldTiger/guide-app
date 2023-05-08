<?php
require_once PROJECT_ROOT_PATH . "../model/Database.php";

class QuestionModel extends Database
{
    public function getQuestionById(int $id): array
    {
        $this->query("SELECT id, question, position, CC, sound FROM questions WHERE id = :id");
        $this->bind(":id", $id);
        return $this->single();
    }

    public function getAnswers(int $id): array
    {
        $this->query("SELECT id, question, answer, money_change, message FROM questions_answers WHERE question = :id");
        $this->bind(":id", $id);
        return $this->resultset();
    }

    public function getQuestions(): array
    {
        $this->query("SELECT id, question, position, CC, sound FROM questions");
        return $this->resultset();
    }

    public function saveQuestion(array $question, array $answers)
    {
        $this->query("UPDATE questions SET question = :question, position = :position, CC = :CC, sound = :sound WHERE id = :id");
        $this->bind(":question", $question["question"]);
        $this->bind(":position", $question["position"]);
        $this->bind(":CC", $question["CC"]);
        $this->bind(":sound", $question["sound"]);
        $this->bind(":id", $question["id"]);
        $this->execute();

        foreach($answers as $answer) {
            $this->query("UPDATE questions_answers SET answer = :answer, money_change = :money, message = :message WHERE id = :id");
            $this->bind(":answer", $answer["answer"]);
            $this->bind(":money", $answer["money_change"]);
            $this->bind(":message", $answer["message"]);
            $this->bind(":id", $answer["id"]);
            $this->execute();
        }
        return true;
    }

    public function saveNewQuestion(array $question, array $answers)
    {
        $this->query("INSERT INTO questions (question, position, CC, sound) VALUES (:question, :position, :CC, :sound)");
        $this->bind(":question", $question["question"]);
        $this->bind(":position", $question["position"]);
        $this->bind(":CC", $question["CC"]);
        $this->bind(":sound", $question["sound"]);
        $this->execute();
        $id = $this->lastInsertId();
        foreach($answers as $answer) {
            $this->query("INSERT INTO questions_answers (question, answer, money_change, message) VALUES (:question, :answer, :money_change, :message)");
            $this->bind(":question", $id);
            $this->bind(":answer", $answer["answer"]);
            $this->bind(":money_change", $answer["money_change"]);
            $this->bind(":message", $answer["message"]);
            $this->execute();
        }
        return true;
    }

    public function deleteQuestion(int $id): bool
    {
        //Smazat otázku i její odpovědi
        $this->query("DELETE FROM questions WHERE id = :id");
        $this->bind(":id", $id);
        return $this->execute();
    }

}
