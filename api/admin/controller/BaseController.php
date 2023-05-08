<?php
use JetBrains\PhpStorm\NoReturn;
abstract class BaseController
{
    /**
     * __call magic method.
     */
    public function __call($name, $arguments) {
        $this->sendOutput('', ['HTTP/1.1 404 Not Found']);
    }

    /**
     * Send API output.
     *
     * @param mixed $data
     * @param array $httpHeaders
     */
    protected function sendOutput($data, array $httpHeaders = []): void
    {
        header_remove('Set-Cookie');

        if (is_array($httpHeaders) && count($httpHeaders)) {
            foreach ($httpHeaders as $httpHeader) {
                header($httpHeader);
            }
        }

        echo $data;
        exit;
    }

    /**
     * Get URI elements.
     *
     * @return array
     */
    protected function getUriSegments(): array
    {
        return explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    }

    protected function methodAction(string $method, callable $func): voids
    {
        $strErrorDesc = '';
        $strErrorHeader = '';
        $responseData = '';

        if ($method === $_SERVER["REQUEST_METHOD"]) {
            try {
                $responseData = json_encode(
                    $func(
                        $strErrorHeader,
                        $strErrorDesc
                    ) ?? '',
                    JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            } catch (JsonException|Error $e) {
                $strErrorDesc = $e->getMessage() . ' Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }

        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(['error' => $strErrorDesc], JSON_THROW_ON_ERROR),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }

    /**
     * Get querystring params.
     *
     * @return array
     */
    protected function getQueryStringParams(): array
    {
        parse_str($_SERVER['QUERY_STRING'], $query);
        return $query;
    }

    protected function checkParams($input, $params){
        $return = "";
        $count = count($params);
        if($count > 0){
            for($i = 0; $i < $count; $i++){
                $prm = $params[$i];
                if(!isset($input[$prm])){
                    $return .= " ".$prm;
                }
            }
            return $return;
        }else{
            return "Params checking failed";
        }
    }

    function input()
    {
        $input = null;
        try {
            $inputJSON = file_get_contents('php://input');
            $input = json_decode($inputJSON, TRUE, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            $strErrorDesc =  'POST data are empty or not valid JSON. Please check '.$e->getTraceAsString();
            $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            self::sendOutput(json_encode(['error' => $strErrorDesc], JSON_THROW_ON_ERROR),
                array('Content-Type: application/json', $strErrorHeader)
            );
            throw new RuntimeException($e->getTraceAsString());
        }
        return $input;
    }
}
