<?php

class App
{

    protected $projectId;
    protected $password;
    protected $data = NULL;
    protected $messages = NULL;
    protected $response = NULL;

    public function __construct($projectId, $password)
    {
        $this->projectId = $projectId;
        $this->password = $password;
        $this->fetchData();
        $this->fetchMessages();
    }

    private function checkPassword()
    {
        $passwordOK = false;
        if ($this->data['password'] !== "") {
            if (hash('sha256', $this->password) === $this->data["password"]) {
                $passwordOK = true;
            }
        } else {
            $passwordOK = true;
        }
        return $passwordOK;
    }

    private function fetchData()
    {
        if (file_exists('projects/' . $this->projectId . '/data.json')) {
            $dataContents = file_get_contents('projects/' . $this->projectId . '/data.json');
            $this->data = json_decode($dataContents, true);
        } else {
            $this->data = array("error" => "Project not exists");
        }
    }

    private function storeData()
    {
        if (file_exists('projects/' . $this->projectId . '/data.json')) {
            $fp = fopen('projects/' . $this->projectId . '/data.json', 'w');
            fwrite($fp, json_encode($this->data));
            fclose($fp);
            return array("success" => "Data stored");
        } else {
            return array("error" => "An error occured");
        }
    }

    private function fetchMessages()
    {
        if (file_exists('projects/' . $this->projectId . '/messages.json')) {
            $messagesContents = file_get_contents('projects/' . $this->projectId . '/messages.json');
            $this->messages = json_decode($messagesContents, true);
        } else {
            $this->messages = array("error" => "File containing messages not found");
        }
    }

    public function getData()
    {
        $response = NULL;
        if (array_key_exists('password', $this->data)) {
            if ($this->checkPassword()) {
                $response = $this->data;
                if (isset($response["password"])) {
                    unset($response["password"]);
                }
            } else {
                $response = array("error" => "Wrong password");
            }
        } else {
            $response = $this->data;
        }
        return $response;
    }

    public function saveData($data)
    {

        foreach ($data as $key => $value) {
            $this->data[$key] = $value;
        }

        return $this->storeData();
    }

    public function getMessages()
    {
        $response = NULL;
        if (array_key_exists('password', $this->data)) {
            if ($this->checkPassword()) {
                $response = $this->messages;
            } else {
                $response = array("error" => "Wrong password");
            }
        } else {
            $response = $this->messages;
        }
        return $response;
    }

    public function getImagesList($dir)
    {
        $results = [];
        if (file_exists($dir)) {
            $files = scandir($dir);
            $excludedFiles = ['.', '..', 'backgrounds', 'devices', 'data.json', 'messages.json'];
            foreach ($files as $file) {
                if (!in_array($file, $excludedFiles)) {
                    array_push($results, $file);
                }
            }
        }
        return $results;
    }
}
