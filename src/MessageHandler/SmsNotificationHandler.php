<?php


namespace App\MessageHandler;


use App\Message\SmsNotificationMessage;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class SmsNotificationHandler implements MessageHandlerInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(SmsNotificationMessage $message)
    {
        $this->logger->info('Do send SMS Notification');
    }
}
