<?php

require __DIR__ . "/inc/bootstrap.php";
//https://code.tutsplus.com/tutorials/how-to-build-a-simple-rest-api-in-php--cms-37000
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);
$notFound = true;

$typePart = 4;
$actionPart = 5;

$endpoints = array(
    "auth" => "AuthController",
    "question" => "QuestionController",
    "event" => "RandomEventsController",
    "player" => "PlayerController"
);
if (isset($uri[$typePart])) {
    $inUrl = $uri[$typePart];
    if (array_key_exists($inUrl, $endpoints)) {
        if (array_key_exists($actionPart, $uri)) {
            $endpointType = $endpoints[$inUrl];
            require PROJECT_ROOT_PATH . "/controller/$endpointType.php";
            $objFeedController = new $endpointType();
            $strMethodName = $uri[$actionPart] . 'Action';
            $objFeedController->{$strMethodName}();
            $notFound = false;
        }
    }
}

if ((!isset($uri[$typePart]) || !isset($uri[$actionPart])) && $notFound) {
    header("HTTP/1.1 404 Not Found");
    exit();
}
?>

<meta http-equiv="Expires" content="Tue, 01 Jan 1994 12:12:12 GMT">
<meta http-equiv="Pragma" content="no-cache">
