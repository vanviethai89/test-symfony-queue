<?php

namespace App\MessageHandler;

use App\Message\NewUserWelcomeEmailMessage;
use App\Notification\SlackNotification;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class NewUserWelcomeEmailHandler implements MessageHandlerInterface
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

    public function __invoke(NewUserWelcomeEmailMessage $sendWelcomeEmailMessage)
    {
        $text = sprintf('Do send welcome email to email #%s',
            $sendWelcomeEmailMessage->getEmail()
        );

        $this->logger->info(
            $text,
            [
                'email'     => $sendWelcomeEmailMessage->getEmail(),
                'firstName' => $sendWelcomeEmailMessage->getFirstName(),
                'lastName'  => $sendWelcomeEmailMessage->getLastName(),
            ]
        );

        $this->logger->info($text);

        $this->slackNotification->notify($text);
    }
}
