<?php

namespace App\Processes\Business;

use GuzzleHttp\Client;

/**
 * Class FCM
 * @package App\Processes\Business
 */
class FCM
{

    protected $endpoint;
    protected $topic;
    protected $data;
    protected $notification;

    public function __construct()
    {
        $this->endpoint = "https://fcm.googleapis.com/fcm/send";
    }

    public function send(string $to, $title, $body)
    {
        $server_key = env("FCM_SERVER_KEY");
        $headers = [
            'Authorization' => 'key=' . $server_key,
            'Content-Type' => 'application/json',
        ];
        $data = [
            "title" => $title,
            "body" => $body,
            "content_available" => true,
            "priority" => "high"
        ];
        $fields = [
            'to' => $to,
            'notification' => $data
        ];
        $fields = json_encode($fields);
        $client = new Client();
        try {
            $request = $client->post($this->endpoint, [
                'headers' => $headers,
                "body" => $fields,
            ]);
            $response = $request->getBody();
            return $response;
        } catch (Exception $e) {
            return $e;
        }
    }
}