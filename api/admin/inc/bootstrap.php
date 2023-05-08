<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (isset($_SERVER['HTTP_ORIGIN'])) {
    //header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header("Access-Control-Allow-Origin: *");
    header('Access-Control-Allow-Credentials: true');
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
}
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers:{$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}

function input()
{
    $input = null;
    try {
        $inputJSON = file_get_contents('php://input');
        $input = json_decode($inputJSON, TRUE, 512, JSON_THROW_ON_ERROR);
    } catch (JsonException $e) {
        $strErrorDesc = $e->getTraceAsString() . ' Something went wrong! Please contact support.';
        $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
        throw new RuntimeException($e->getTraceAsString());
    }
    return $input;
}



define("PROJECT_ROOT_PATH", __DIR__ . "/../");

// include the base controller file
require_once PROJECT_ROOT_PATH . "/controller/BaseController.php";

// include the use model file
require_once PROJECT_ROOT_PATH . "/model/StatsModel.php";
require_once PROJECT_ROOT_PATH . "/model/QuestionModel.php";
require_once PROJECT_ROOT_PATH . "/model/EventModel.php";
require_once PROJECT_ROOT_PATH . "/model/PlayerModel.php";


?>
