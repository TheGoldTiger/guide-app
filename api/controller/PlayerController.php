<?php

class PlayerController extends BaseController
{
    public function getAllPlayersAction(): void
    {
        $func = function () {
            return (new PlayerModel())->getAllPlayers();
        };

        $this->methodAction("GET", $func);
    }

    public function getPlayerByNameAction()
    {
        $func = function (&$errorHeader, &$errorDesc) {
            $queryParams = $this->getQueryStringParams();
            if (isset($queryParams['name']) && $queryParams['name']) {
                return (new PlayerModel())->getPlayerByName($queryParams['name']);
            }

            $errorHeader = 'HTTP/1.1 422 Unprocessable Entity';
            $errorDesc = 'Missing parameter name';

            return null;
        };

        $this->methodAction("GET", $func);
    }

    public function getPlayerByTokenAction()
    {
        $func = function (&$errorHeader, &$errorDesc) {
            $queryParams = $this->getQueryStringParams();
            if (isset($queryParams['token']) && $queryParams['token']) {
                return (new PlayerModel())->getPlayerByToken($queryParams['token']);
            }

            $errorHeader = 'HTTP/1.1 422 Unprocessable Entity';
            $errorDesc = 'Missing parameter token';

            return null;
        };

        $this->methodAction("GET", $func);
    }

    public function isWinnerDisplayAction()
    {
        $func = function (&$errorHeader, &$errorDesc) {
            $queryParams = $this->getQueryStringParams();
            if (isset($queryParams['player']) && $queryParams['player']) {
                return (new PlayerModel())->isWinnerDisplay($queryParams['player']);
            }

            $errorHeader = 'HTTP/1.1 422 Unprocessable Entity';
            $errorDesc = 'Missing parameter player';

            return null;
        };

        $this->methodAction("GET", $func);
    }

    public function getAllWinnersAction(): void
    {
        $func = function () {
            return (new PlayerModel())->getAllWinners();
        };

        $this->methodAction("GET", $func);
    }

    public function changePlayerMoneyAction(): void
    {
        $func = function () {
            try {
                if (isset($this->input()["player"], $this->input()["money"])) {
                    return (new PlayerModel())->changePlayerMoney($this->input()["player"], $this->input()["money"]);
                }
                $params = $this->checkParams($this->input(), array("player", "money"));
                $errorHeader = 'HTTP/1.1 422 Unprocessable Entity';
                $errorDesc = 'Missing parameter ' . $params;

                return null;
            } catch (JsonException $e) {
                throw new RuntimeException($e->getTraceAsString());
            }
        };

        $this->methodAction("POST", $func);

    }

    public function addPlayerAction(): void
    {
        $func = function () {
            try {
                if (isset($this->input()["name"])) {
                    return (new PlayerModel())->addPlayer($this->input()["name"]);
                }
                $params = $this->checkParams($this->input(), array("name"));
                $errorHeader = 'HTTP/1.1 422 Unprocessable Entity';
                $errorDesc = 'Missing parameter ' . $params;

                return null;
            } catch (JsonException $e) {
                throw new RuntimeException($e->getTraceAsString());
            }
        };

        $this->methodAction("POST", $func);

    }

    public function removePlayerAction(): void
    {
        $func = function () {
            try {
                if (isset($this->input()["id"])) {
                    return (new PlayerModel())->removePlayer($this->input()["id"]);
                }
                $params = $this->checkParams($this->input(), array("id"));
                $errorHeader = 'HTTP/1.1 422 Unprocessable Entity';
                $errorDesc = 'Missing parameter ' . $params;

                return null;
            } catch (JsonException $e) {
                throw new RuntimeException($e->getTraceAsString());
            }
        };

        $this->methodAction("POST", $func);

    }

    public function setPlayerForVisibleInLeaderboardsAction(): void
    {
        $func = function () {
            try {
                if (isset($this->input()["id"])) {
                    return (new PlayerModel())->setPlayerForLeaderboards($this->input()["id"]);
                }
                $params = $this->checkParams($this->input(), array("id"));
                $errorHeader = 'HTTP/1.1 422 Unprocessable Entity';
                $errorDesc = 'Missing parameter ' . $params;

                return null;
            } catch (JsonException $e) {
                throw new RuntimeException($e->getTraceAsString());
            }
        };

        $this->methodAction("POST", $func);

    }

}
