<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

function generateId($length = 6)
{
    $randomString = null;
    $characters = '23456789abcdefghijkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = null;
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function createProjectDir($projectId)
{
    if (!mkdir('./projects/' . $projectId)) {
        createProjectDir(generateId());
    };
    return $projectId;
}

function saveJson($data, $filename)
{
    $formattedData = json_encode($data);
    $handle = fopen($filename, 'w+');
    fwrite($handle, $formattedData);
    fclose($handle);
}

function generateDataJson($projectId)
{
    $data = array(
        "projectId" => $projectId,
        "name" => "My project",
        "numberOfVersions" => 1,
        "password" => "",
        "error" => "",
        "backgrounds" => array(),
        "devices" => array(),
        "pages" => array()
    );
    saveJson($data, './projects/' . $projectId . '/data.json');
}


function generateMessagesJson($projectId)
{
    $data = array(
        "messages" => array(),
        "comments" => array()
    );
    saveJson($data, './projects/' . $projectId . '/messages.json');
}

$projectId = createProjectDir(generateId());
generateDataJson($projectId);
generateMessagesJson($projectId);

$json = json_encode($projectId);
echo $json;
