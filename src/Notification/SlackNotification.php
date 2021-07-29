<?php

namespace App\Notification;

class SlackNotification
{
    public function notify($text)
    {
        if (!$_ENV['SLACK_WEB_HOOK_URL']) {
            return;
        }

        $curl = curl_init();

        $postData = [
            'text' => $text
        ];

        curl_setopt_array($curl, array(
            CURLOPT_URL            => $_ENV['SLACK_WEB_HOOK_URL'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_POSTFIELDS     => json_encode($postData),
            CURLOPT_HTTPHEADER     => array(
                'Content-type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }
}
