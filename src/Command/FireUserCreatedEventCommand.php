<?php

namespace App\Command;

use App\Event\UserCreatedEvent;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class FireUserCreatedEventCommand extends Command
{
    protected static $defaultName = 'app:fire-user-created-event';
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    public function __construct(string $name = null, EventDispatcherInterface $eventDispatcher)
    {
        parent::__construct($name);

        $this->eventDispatcher = $eventDispatcher;
    }

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
            ->addArgument('email', InputArgument::REQUIRED, 'Email')
            ->addArgument('firstName', InputArgument::REQUIRED, 'First name')
            ->addArgument('lastName', InputArgument::REQUIRED, 'Last name ');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $email = $input->getArgument('email');
        $firstName = $input->getArgument('firstName');
        $lastName = $input->getArgument('lastName');

        $this->eventDispatcher->dispatch(
            new UserCreatedEvent(
                $email,
                $firstName,
                $lastName
            ),
            UserCreatedEvent::NAME
        );

        $io->success('Done');
    }
}
