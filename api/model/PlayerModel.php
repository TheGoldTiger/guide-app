<?php
require_once PROJECT_ROOT_PATH . "/model/Database.php";

class PlayerModel extends Database
{
    public function getAllPlayers(): array
    {
        $this->query("SELECT id, name, token, money, created FROM player");
        return $this->resultset();
    }

    public function getPlayerByName(string $name): array
    {
        $this->query("SELECT id, name, token, money, created FROM player WHERE name = :name");
        $this->bind(":name", $name);
        return $this->resultset();
    }

    public function getPlayerByToken(string $token): array
    {
        $this->query("SELECT id, name, token, money, created FROM player WHERE token = :token");
        $this->bind(":token", $token);
        return $this->resultset();
    }

    public function getAllWinners(): array
    {
        $this->query("SELECT id, name, token, money, created FROM player WHERE display_winner = 1");
        return $this->resultset();
    }

    public function changePlayerMoney(int $player, int $money): bool
    {
        $this->query("UPDATE player SET money = :money WHERE id = :id");
        $this->bind(":money", $money);
        $this->bind(":id", $player);
        return $this->execute();
    }

    public function addPlayer(string $name): array
    {
        $name .= rand(100, 999);
        $token = hash( 'sha256', $name."25698");
        $money = 10000;
        $this->query("INSERT INTO player (name, token, money) VALUES (:name, :token, :money)");
        $this->bind(":name", $name);
        $this->bind(":token", $token);
        $this->bind(":money", $money);
        $this->execute();
        $lastId = $this->lastInsertId();
        return Array("id" => $lastId, "name" => $name, "token" => $token);
    }

    public function removePlayer(int $id): bool
    {
        $this->query("DELETE FROM player WHERE id = :id");
        $this->bind(":id", $id);
        return $this->execute();

    }

    public function setPlayerForLeaderboards(int $id): bool
    {
        $this->query("UPDATE player SET display_winner = 1 WHERE id = :id");
        $this->bind(":id", $id);
        return $this->execute();

    }

    public function isWinnerDisplay(int $id): bool
    {
        $this->query("SELECT display_winner FROM player WHERE id = :id");
        $this->bind(":id", $id);
        return $this->single()["display_winner"];

    }



}
