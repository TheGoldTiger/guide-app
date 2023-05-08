<?php
require __DIR__ . "/inc/bootstrap.php";
//https://code.tutsplus.com/tutorials/how-to-build-a-simple-rest-api-in-php--cms-37000
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );
$notFound = true;

$typePart = 4;
$actionPart = 5;
if(isset($uri[$typePart]) && $uri[$typePart] === 'stats'){
  require PROJECT_ROOT_PATH . "/controller/StatsController.php";

  $objFeedController = new StatsController();
  $strMethodName = $uri[$actionPart] . 'Action';
  $objFeedController->{$strMethodName}();
  $notFound = false;
}

if(isset($uri[$typePart]) && $uri[$typePart] === 'question'){
    require PROJECT_ROOT_PATH . "/controller/QuestionController.php";

    $objFeedController = new QuestionController();
    $strMethodName = $uri[$actionPart] . 'Action';
    $objFeedController->{$strMethodName}();
    $notFound = false;
}

if(isset($uri[$typePart]) && $uri[$typePart] === 'event'){
    require PROJECT_ROOT_PATH . "/controller/EventController.php";

    $objFeedController = new EventController();
    $strMethodName = $uri[$actionPart] . 'Action';
    $objFeedController->{$strMethodName}();
    $notFound = false;
}

if(isset($uri[$typePart]) && $uri[$typePart] === 'player'){
    require PROJECT_ROOT_PATH . "/controller/PlayerController.php";

    $objFeedController = new PlayerController();
    $strMethodName = $uri[$actionPart] . 'Action';
    $objFeedController->{$strMethodName}();
    $notFound = false;
}

if (!isset($uri[4]) || !isset($uri[5]) || $notFound) {
    header("HTTP/1.1 404 Not Found");
    exit();
}
?>

<meta http-equiv="Expires" content="Tue, 01 Jan 1994 12:12:12 GMT">
<meta http-equiv="Pragma" content="no-cache">
