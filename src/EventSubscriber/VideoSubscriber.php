<?php

namespace App\EventSubscriber;

use App\Event\VideoCreatedEvent;
use App\Message\EncodeVideoMessage;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class VideoSubscriber implements EventSubscriberInterface
{
    /**
     * @var MessageBusInterface
     */
    private $messageBus;

    public function __construct(
        MessageBusInterface $messageBus
    ) {
        $this->messageBus = $messageBus;
    }

    /**
     * @param VideoCreatedEvent $event
     */
    public function onVideoCreated($event)
    {
        // Encode video
        $this->messageBus->dispatch(
            new EncodeVideoMessage(
                $event->getVideoId(),
                $event->getVideoPath()
            )
        );
    }

    public static function getSubscribedEvents()
    {
        return [
            VideoCreatedEvent::NAME => 'onVideoCreated',
        ];
    }
}
