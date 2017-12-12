<?php
include_once 'App.php';

$app = new App();
$data = $app->getData();

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$json = json_encode($data);
echo $json;
/*
    098f6bcd4621d373cade4e832627b4f6
 */
