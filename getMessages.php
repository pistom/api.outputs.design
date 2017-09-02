<?php
include_once 'App.php';

$app = new App();
$data = $app->getMessages();

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$json = json_encode($data);
echo $json;
