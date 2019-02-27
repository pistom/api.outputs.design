<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$projectId = (isset($_POST["projectId"])) ? htmlspecialchars($_POST["projectId"]) : NULL;
$message = (isset($_POST["message"])) ? htmlspecialchars($_POST["message"]) : NULL;
$type = (isset($_POST["type"])) ? htmlspecialchars($_POST["type"]) : NULL;
$date = (isset($_POST["date"])) ? htmlspecialchars($_POST["date"]) : NULL;
$time = (isset($_POST["time"])) ? htmlspecialchars($_POST["time"]) : NULL;

$status = NULL;

if (file_exists('projects/' . $projectId . '/messages.json')) {
    $messagesContents = file_get_contents('projects/' . $projectId . '/messages.json');
    $messages = json_decode($messagesContents, true);

    array_push($messages["messages"], array(
            "content"=>$message,
            "type"=>$type,
            "date"=>$date,
            "thime"=>$time
    ));

    $fp = fopen('projects/' . $projectId . '/messages.json', 'w');
    fwrite($fp, json_encode($messages));
    fclose($fp);

    $status = "success";

} else {
    $status = "error";
}


echo json_encode($status);
