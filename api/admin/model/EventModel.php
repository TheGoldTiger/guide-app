<?php
require_once PROJECT_ROOT_PATH . "../model/Database.php";

class EventModel extends Database
{
    public function getEventById(int $id): array
    {
        $this->query("SELECT id, question, position FROM questions WHERE id = :id");
        $this->bind(":id", $id);
        return $this->single();
    }

    public function getEvents(): array
    {
        $this->query("SELECT id, text, money_change, kod FROM random_events");
        return $this->resultset();
    }

    public function deleteEvent(int $id): bool
    {
        $this->query("DELETE FROM random_events WHERE id = :id");
        $this->bind(":id", $id);
        return $this->execute();
    }

}
