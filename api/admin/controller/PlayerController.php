<?php

class PlayerController extends BaseController
{


    public function getPlayersAction(): void
    {
        $func = function (&$errorHeader, &$errorDesc) {
                return (new PlayerModel())->getPlayers();
        };

        $this->methodAction("GET", $func);
    }

    public function deletePlayerAction()
    {
        $func = function () {
            try {
                if (isset(input()["id"])) {
                    return (new PlayerModel())->deletePlayer(input()["id"]);
                }
                $params = $this->checkParams(input(), array("id"));
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
