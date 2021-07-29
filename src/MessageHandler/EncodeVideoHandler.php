<?php

namespace App\MessageHandler;

use App\Message\EncodeVideoMessage;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class EncodeVideoHandler implements MessageHandlerInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(EncodeVideoMessage $encodeVideoMessage)
    {
        $this->logger->info(
            sprintf('Do encode video #%s on path: "%s"',
                $encodeVideoMessage->getVideoId(),
                $encodeVideoMessage->getVideoPath()
            )
        );
    }
}
