<?php


namespace App\Message;


class SmsNotificationMessage
{
    private $content;

    public function __construct(string $content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }
}
