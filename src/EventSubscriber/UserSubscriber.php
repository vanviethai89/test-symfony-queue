<?php

namespace App\EventSubscriber;

use App\Event\UserCreatedEvent;
use App\Message\NewUserWelcomeEmailMessage;
use App\Message\WhatEverName;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class UserSubscriber implements EventSubscriberInterface
{
    /**
     * @var MessageBusInterface
     */
    private $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    /**
     * @param UserCreatedEvent $event
     */
    public function onUserCreated($event)
    {
        // Send mail welcome to the user
        $this->messageBus->dispatch(
            new NewUserWelcomeEmailMessage(
                $event->getEmail(),
                $event->getFirstName(),
                $event->getLastName()
            )
        );
    }

    public static function getSubscribedEvents()
    {
        return [
            UserCreatedEvent::NAME => 'onUserCreated',
        ];
    }
}
