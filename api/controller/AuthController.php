<?php

class AuthController extends BaseController
{

    public function loginAction()
    {
        $func = function () {
            try {
                if (isset($this->input()["email"], $this->input()["password"])) {
                    return (new AuthModel())->logIn($this->input()["email"], $this->input()["password"]);
                }
                $params = $this->checkParams($this->input(), array("email", "password"));
                $errorHeader = 'HTTP/1.1 422 Unprocessable Entity';
                $errorDesc = 'Missing parameter ' . $params;

                return null;
            } catch (JsonException $e) {
                throw new RuntimeException($e->getTraceAsString());
            }
        };

        $this->methodAction("POST", $func);

    }


    public function meAction()
    {
        $func = function () {
            try {
                if (isset($this->input()["token"])) {
                    return (new AuthModel())->getMe($this->input()["token"]);
                }
                $params = $this->checkParams($this->input(), array("token"));
                $errorHeader = 'HTTP/1.1 422 Unprocessable Entity';
                $errorDesc = 'Missing parameter ' . $params;

                return null;
            } catch (JsonException $e) {
                throw new RuntimeException($e->getTraceAsString());
            }
        };

        $this->methodAction("POST", $func);

    }

    public function authCheckAction()
    {
        $func = function () {
            try {
                if (isset($this->input()["token"])) {
                    return (new AuthModel())->checkAuth($this->input()["token"]);
                }
                $params = $this->checkParams($this->input(), array("token"));
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
