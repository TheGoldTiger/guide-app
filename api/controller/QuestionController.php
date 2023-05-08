<?php

class QuestionController extends BaseController
{
    public function getQuestionForPlayerAction(): void
    {
        $func = function (&$errorHeader, &$errorDesc) {
            $queryParams = $this->getQueryStringParams();
            if (isset($queryParams['player']) && $queryParams['player']) {
                return (new QuestionModel())->getQuestionForPlayer($queryParams['player']);
            }

            $errorHeader = 'HTTP/1.1 422 Unprocessable Entity';
            $errorDesc = 'Missing parameter player';

            return null;
        };

        $this->methodAction("GET", $func);
    }

    public function sendAnswerForPlayerAction(): void
    {
        $func = function () {
            try {
                if (isset($this->input()["player"], $this->input()["answer"])) {
                    return (new QuestionModel())->sendAnswerPlayer($this->input()["player"], $this->input()["answer"]);
                }
                /*$params = $this->checkParams($this->input(), array("user", "answer"));
                $errorHeader = 'HTTP/1.1 422 Unprocessable Entity';
                $errorDesc = 'Missing parameter ' . $params;

                return null;*/
            } catch (JsonException $e) {
                throw new RuntimeException($e->getTraceAsString());
            }
        };

        $this->methodAction("POST", $func);

    }
}
