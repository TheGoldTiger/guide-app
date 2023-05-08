<?php

class EventController extends BaseController
{


    public function getEventByIdAction(): void
    {
        $func = function (&$errorHeader, &$errorDesc) {
            $queryParams = $this->getQueryStringParams();
            if (isset($queryParams['id']) && $queryParams['id']) {
                return (new EventModel())->getEventbyId($queryParams['id']);
            }

            $errorHeader = 'HTTP/1.1 422 Unprocessable Entity';
            $errorDesc = 'Missing parameter id';

            return null;
        };

        $this->methodAction("GET", $func);
    }

    public function getEventsAction(): void
    {
        $func = function (&$errorHeader, &$errorDesc) {
                return (new EventModel())->getEvents();
        };

        $this->methodAction("GET", $func);
    }

    public function deleteEventAction()
    {
        $func = function () {
            try {
                if (isset(input()["id"])) {
                    return (new EventModel())->deleteEvent(input()["id"]);
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
