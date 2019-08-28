<?php

namespace App\Controller;

use App\Message\EmailNotificationMessage;
use App\Message\SmsNotificationMessage;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/default", name="default")
     */
    public function index(MessageBusInterface $messageBus, LoggerInterface $logger)
    {
        $messageBus->dispatch(new SmsNotificationMessage('Look! I created a message!'));
        $messageBus->dispatch(new EmailNotificationMessage('Look! I created a message!'));

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/DefaultController.php',
        ]);
    }
}
