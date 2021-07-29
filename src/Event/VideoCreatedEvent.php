<?php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

class VideoCreatedEvent extends Event
{
    public const NAME = 'video.created';

    /**
     * @var string
     */
    private $videoId;

    /**
     * @var string
     */
    private $videoPath;

    public function __construct(string $videoId, string $videoPath)
    {
        $this->videoId = $videoId;
        $this->videoPath = $videoPath;
    }

    /**
     * @return string
     */
    public function getVideoId(): string
    {
        return $this->videoId;
    }

    /**
     * @return string
     */
    public function getVideoPath(): string
    {
        return $this->videoPath;
    }
}
