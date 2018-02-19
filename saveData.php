<?php
include_once 'App.php';

$projectId = (isset($_GET["projectId"])) ? htmlspecialchars($_GET["projectId"]) : NULL;
$password = (isset($_POST["password"])) ? htmlspecialchars($_POST["password"]) : NULL;
$data = (isset($_POST["data"])) ? json_decode($_POST["data"]) : NULL;

$app = new App($projectId, $password);
$response = $app->saveData($data);

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$json = json_encode($response);
echo $json;
