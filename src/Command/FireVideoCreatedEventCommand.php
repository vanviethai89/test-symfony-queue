<?php

namespace App\Command;

use App\Event\VideoCreatedEvent;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class FireVideoCreatedEventCommand extends Command
{
    protected static $defaultName = 'app:fire-video-created-event';

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
            ->setDescription('Fire video created event')
            ->addArgument('videoId', InputArgument::REQUIRED, 'Id of video')
            ->addArgument('videoPath', InputArgument::REQUIRED, 'Path of video');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $videoId = $input->getArgument('videoId');
        $videoPath = $input->getArgument('videoPath');

        $this->eventDispatcher->dispatch(
            new VideoCreatedEvent(
                $videoId,
                $videoPath
            ),
            VideoCreatedEvent::NAME
        );

        $io->success('Done !');
    }
}
