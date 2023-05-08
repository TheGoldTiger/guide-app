<?php
require_once PROJECT_ROOT_PATH . "../model/Database.php";

class StatsModel extends Database
{
    public function getNumberOfPlayers(): int
    {
        $this->query("SELECT COUNT(*) AS pocet FROM player");
        return $this->single()["pocet"];
    }

    public function getNumberOfAnswers(): int
    {
        $this->query("SELECT COUNT(*) AS pocet FROM player_answers");
        return $this->single()["pocet"];
    }

    public function getNumberOfRandomEventsUsed(): int
    {
        $this->query("SELECT COUNT(*) AS pocet FROM player_random_event");
        return $this->single()["pocet"];
    }

    public function getNumberReceivedMoney(): int
    {
        $this->query("SELECT SUM(money) AS pocet FROM player_answer_log WHERE money > 0");
        $answers = $this->single()["pocet"];
        $this->query("SELECT SUM(money) AS pocet FROM player_random_event WHERE money > 0");
        $event = $this->single()["pocet"];
        return $answers + $event;
    }

    public function getNumberLostMoney(): int
    {
        $this->query("SELECT SUM(money) AS pocet FROM player_answer_log WHERE money < 0");
        $answers = $this->single()["pocet"];
        $this->query("SELECT SUM(money) AS pocet FROM player_random_event WHERE money < 0");
        $event = $this->single()["pocet"];
        return $answers + $event;
    }

    public function winnerCount(): int
    {
        $this->query("SELECT COUNT(*) AS pocet FROM player WHERE complete = 1");
        return $this->single()["pocet"];
    }

    public function topPlayers(): array
    {
        $this->query("SELECT id, name, money, complete, display_winner FROM player ORDER BY money DESC");
        return $this->resultset();
    }

    public function getQuestion($id): array
    {
        $this->query("SELECT id, question, position FROM questions WHERE id = :id");
        $this->bind(":id", $id);
        return $this->single();
    }

    public function getAllQuestions(): array
    {
        $this->query("SELECT id, question, position FROM questions ORDER BY position ASC");
        return $this->resultset();
    }

    public function getAnswersOnQuestion($id)
    {
        $this->query("SELECT COUNT(*) AS count, qa.answer, qa.money_change 
                        FROM player_answers As a 
                        LEFT JOIN questions_answers AS qa ON qa.id = a.answer 
                        WHERE a.question = :question 
                        GROUP BY a.answer 
                        ORDER BY qa.id ASC");
        $this->bind(":question", $id);
        $questions =  $this->resultset();
        /*$sum = 0;
        foreach($questions as $q){
            $sum += $q["count"];
        }
        $count = count($questions);
        $questions[$count+1]["total_answers"] = $sum;*/
        return $questions;
    }
}
