<?php

class StatsController extends BaseController
{

    public function authCheckAction()
    {
        $func = function () {
            try {
                if (isset(input()["token"])) {
                    return (new AuthModel())->checkAuth(input()["token"]);
                }
                $params = $this->checkParams(input(), array("token"));
                $errorHeader = 'HTTP/1.1 422 Unprocessable Entity';
                $errorDesc = 'Missing parameter ' . $params;

                return null;
            } catch (JsonException $e) {
                throw new RuntimeException($e->getTraceAsString());
            }
        };

        $this->methodAction("POST", $func);

    }

    public function getNumberOfPlayersAction(): void
    {
        $func = function () {
            return (new StatsModel())->getNumberOfPlayers();
        };

        $this->methodAction("GET", $func);
    }

    public function getNumberOfAnswersAction(): void
    {
        $func = function () {
            return (new StatsModel())->getNumberOfAnswers();
        };

        $this->methodAction("GET", $func);
    }

    public function getNumberOfRandomEventsUsedAction(): void
    {
        $func = function () {
            return (new StatsModel())->getNumberOfRandomEventsUsed();
        };

        $this->methodAction("GET", $func);
    }

    public function getNumberReceivedMoneyAction(): void
    {
        $func = function () {
            return (new StatsModel())->getNumberReceivedMoney();
        };

        $this->methodAction("GET", $func);
    }

    public function getNumberLostMoneyAction(): void
    {
        $func = function () {
            return (new StatsModel())->getNumberLostMoney();
        };

        $this->methodAction("GET", $func);
    }

    public function winnerCountAction(): void
    {
        $func = function () {
            return (new StatsModel())->winnerCount();
        };

        $this->methodAction("GET", $func);
    }

    public function topPlayersAction(): void
    {
        $func = function () {
            return (new StatsModel())->topPlayers();
        };

        $this->methodAction("GET", $func);
    }

    public function getQuestionAction(): void
    {
        $func = function (&$errorHeader, &$errorDesc) {
            $queryParams = $this->getQueryStringParams();
            if (isset($queryParams['id']) && $queryParams['id']) {
                return (new StatsModel())->getQuestion($queryParams['id']);
            }

            $errorHeader = 'HTTP/1.1 422 Unprocessable Entity';
            $errorDesc = 'Missing parameter id';

            return null;
        };

        $this->methodAction("GET", $func);
    }

    public function getAllQuestionsAction(): void
    {
        $func = function (&$errorHeader, &$errorDesc) {
            return (new StatsModel())->getAllQuestions();
        };

        $this->methodAction("GET", $func);
    }

    public function getAnswersOnQuestionAction(): void
    {
        $func = function (&$errorHeader, &$errorDesc) {
            $queryParams = $this->getQueryStringParams();
            if (isset($queryParams['id']) && $queryParams['id']) {
                return (new StatsModel())->getAnswersOnQuestion($queryParams['id']);
            }

            $errorHeader = 'HTTP/1.1 422 Unprocessable Entity';
            $errorDesc = 'Missing parameter id';

            return null;
        };

        $this->methodAction("GET", $func);
    }

}
