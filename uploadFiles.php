<?php
include_once 'App.php';

$projectId = (isset($_GET["projectId"])) ? htmlspecialchars($_GET["projectId"]) : NULL;
$imageType = (isset($_GET["imageType"])) ? htmlspecialchars($_GET["imageType"]) : NULL;
$subfolder = NULL;
switch ($imageType) {
    case "project":
        $subfolder = '/';
        break;
    case "background":
        $subfolder = '/backgrounds/';
        if (!file_exists('./projects/'.$projectId.'/backgrounds')) {
            mkdir('./projects/'.$projectId.'/backgrounds', 0777, true);
        }
        break;
    case "device":
        $subfolder = '/devices/';
        if (!file_exists('./projects/'.$projectId.'/devices')) {
            mkdir('./projects/'.$projectId.'/devices', 0777, true);
        }
        break;
    default:
        $subfolder = '/';
}

$my_file = $_FILES['my_file'];
$file_path = $my_file['tmp_name'];
$file_name = $my_file['name'];

$status = array();
if (move_uploaded_file($file_path, './projects/' . $projectId . $subfolder . basename($file_name))) {
    array("status" => "success");
} else {
    array("status" => "error");
}

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$json = json_encode($status);
echo $json;
