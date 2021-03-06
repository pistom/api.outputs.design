<?php
include_once 'App.php';

$projectId = (isset($_GET["projectId"])) ? htmlspecialchars($_GET["projectId"]) : NULL;
$password = (isset($_POST["password"])) ? htmlspecialchars($_POST["password"]) : NULL;

$app = new App($projectId, $password);
$data = $app->getData();

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$json = json_encode($data);
echo $json;
/*
    098f6bcd4621d373cade4e832627b4f6
 */
