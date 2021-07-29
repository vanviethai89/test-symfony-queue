<?php

namespace App\MessageHandler;

use App\Message\EncodeVideoMessage;
use App\Notification\SlackNotification;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class EncodeVideoHandler implements MessageHandlerInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var SlackNotification
     */
    private $slackNotification;

    public function __construct(LoggerInterface $logger, SlackNotification $slackNotification)
    {
        $this->logger = $logger;
        $this->slackNotification = $slackNotification;
    }

    public function __invoke(EncodeVideoMessage $encodeVideoMessage)
    {
        $text = sprintf('Do encode video #%s on path: "%s"',
            $encodeVideoMessage->getVideoId(),
            $encodeVideoMessage->getVideoPath()
        );

        $this->logger->info($text);

        $this->slackNotification->notify($text);
    }
}
