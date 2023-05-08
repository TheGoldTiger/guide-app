<?php

class QuestionController extends BaseController
{


    public function getQuestionByIdAction(): void
    {
        $func = function (&$errorHeader, &$errorDesc) {
            $queryParams = $this->getQueryStringParams();
            if (isset($queryParams['id']) && $queryParams['id']) {
                return (new QuestionModel())->getQuestionbyId($queryParams['id']);
            }

            $errorHeader = 'HTTP/1.1 422 Unprocessable Entity';
            $errorDesc = 'Missing parameter id';

            return null;
        };

        $this->methodAction("GET", $func);
    }

    public function getAnswersOnQuestionAction(): void
    {
        $func = function (&$errorHeader, &$errorDesc) {
            $queryParams = $this->getQueryStringParams();
            if (isset($queryParams['id']) && $queryParams['id']) {
                return (new QuestionModel())->getAnswers($queryParams['id']);
            }

            $errorHeader = 'HTTP/1.1 422 Unprocessable Entity';
            $errorDesc = 'Missing parameter id';

            return null;
        };

        $this->methodAction("GET", $func);
    }

    public function getQuestionsAction(): void
    {
        $func = function (&$errorHeader, &$errorDesc) {
                return (new QuestionModel())->getQuestions();
        };

        $this->methodAction("GET", $func);
    }

    public function saveQuestionAction()
    {
        $func = function () {
            try {
                if (isset(input()["question"], input()["answers"])) {
                    return (new QuestionModel())->saveQuestion(input()["question"], input()["answers"]);
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

    public function deleteQuestionAction()
    {
        $func = function () {
            try {
                if (isset(input()["id"])) {
                    return (new QuestionModel())->deleteQuestion(input()["id"]);
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

    public function saveNewQuestionAction()
    {
        $func = function () {
            try {
                if (isset(input()["question"], input()["answers"])) {
                    return (new QuestionModel())->saveNewQuestion(input()["question"], input()["answers"]);
                }
                $params = $this->checkParams(input(), array("question, answers"));
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
