<?php

namespace App\MessageHandler;

use App\Message\NewUserWelcomeEmailMessage;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class NewUserWelcomeEmailHandler implements MessageHandlerInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(NewUserWelcomeEmailMessage $sendWelcomeEmailMessage)
    {
        $this->logger->info(
            sprintf('Do send welcome email to email #%s',
                $sendWelcomeEmailMessage->getEmail()
            ),
            [
                'email'     => $sendWelcomeEmailMessage->getEmail(),
                'firstName' => $sendWelcomeEmailMessage->getFirstName(),
                'lastName'  => $sendWelcomeEmailMessage->getLastName(),
            ]
        );
    }
}
