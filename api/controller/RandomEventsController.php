<?php

class RandomEventsController extends BaseController
{
    public function getEventByCodeAction()
    {
        $func = function (&$errorHeader, &$errorDesc) {
            $queryParams = $this->getQueryStringParams();
            //$queryParams = $this->getQueryStringParams();
            if (isset($queryParams['code'], $queryParams['id']) && $queryParams['code'] && $queryParams['id']) {
                return (new RandomEventsModel())->GetEventByCode($queryParams);
            }

            $params = $this->checkParams($queryParams, array("code", "id"));
            $errorHeader = 'HTTP/1.1 422 Unprocessable Entity';
            $errorDesc = 'Missing parameters ' . $params;

            return null;
        };

        $this->methodAction("GET", $func);
    }

}
