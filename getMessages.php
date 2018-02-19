<?php
include_once 'App.php';

$projectId = (isset($_GET["projectId"])) ? htmlspecialchars($_GET["projectId"]) : NULL;
$password = (isset($_POST["password"])) ? htmlspecialchars($_POST["password"]) : NULL;

$app = new App($projectId, $password);
$data = $app->getMessages();

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$json = json_encode($data);
echo $json;
