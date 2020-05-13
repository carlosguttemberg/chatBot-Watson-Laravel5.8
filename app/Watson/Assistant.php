<?php

namespace App\Watson;

use GuzzleHttp\Client;

class Assistant

{
    private $username;
    private $password;
    private $workspace;


    public function __construct(string $username, string $password, string $workspace){
        $this->username = $username; 
        $this->password = $password; 
        $this->workspace = $workspace; 
    }


    public function dialog(string $message){
        
        $client = new Client;
        //https://api.us-south.assistant.watson.cloud.ibm.com/v2/assistants/fad21566-55b5-4f71-8c1b-b51949881b90/sessions?version=2020-04-01
        $url = 'https://api.us-south.assistant.watson.cloud.ibm.com/v2/assistants/' . $this->workspace . '/message?version=2020-04-01';

        $response = $client->request('POST', $url, [
            'json' => [
                'input' => [
                    'text' => $message
                ]
            ],
            'auth' => [
                $this->username, $this->password
            ]
        ]);

        return (string) $response->getBody();
    }
}

?>