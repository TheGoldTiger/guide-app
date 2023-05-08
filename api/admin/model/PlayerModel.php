<?php
require_once PROJECT_ROOT_PATH . "../model/Database.php";

class PlayerModel extends Database
{
    public function getPlayers(): array
    {
        $this->query("SELECT id, name, money, complete, display_winner FROM player ORDER BY money DESC LIMIT 15");
        return $this->resultset();
    }

    public function deletePlayer(int $id): bool
    {
        $this->query("DELETE FROM player WHERE id = :id");
        $this->bind(":id", $id);
        return $this->execute();
    }

}
