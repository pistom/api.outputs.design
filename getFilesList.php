<?php
include_once 'App.php';

$projectId = (isset($_GET["projectId"])) ? htmlspecialchars($_GET["projectId"]) : NULL;
$imageType = (isset($_POST["imagesType"])) ? htmlspecialchars($_POST["imagesType"]) : NULL;

$app = new App($projectId, NULL);
$data = $app->getImagesList($imageType);

$imagesList = [];
switch ($imageType) {
    case "project":
        $imagesList["project"] = $app->getImagesList('./projects/'.$projectId);
        break;
    case "background":
        $imagesList["background"] = $app->getImagesList('./projects/'.$projectId.'/backgrounds');
        break;
    case "device":
        $imagesList["device"] = $app->getImagesList('./projects/'.$projectId.'/devices');
        break;
    default:
        $imageType = [];
}

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$json = json_encode($imagesList);
echo $json;
