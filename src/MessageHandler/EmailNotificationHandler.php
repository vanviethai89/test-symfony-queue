<?php


namespace App\MessageHandler;


use App\Message\EmailNotificationMessage;
use Psr\Log\LoggerInterface;

class EmailNotificationHandler
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(EmailNotificationMessage $message)
    {
        $this->logger->info('Do send Email Notification');
    }
}
