<?php

namespace Framework\Action;

use Framework\Ability\BrowseWebsite;
use Framework\Actor\ActorInterface;
use Framework\PerformableInterface;

class OpenPage implements PerformableInterface
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $site;

    public function __construct(string $path, string $site = 'default')
    {
        $this->path = $path;
        $this->site = $site;
    }

    public function performAs(ActorInterface $actor): void
    {
        /** @var BrowseWebsite $browseWebsite */
        $browseWebsite = $actor->ableTo('browseWebsite');

        $driver = $browseWebsite->getDriver();
        $site = $browseWebsite->getSite($this->site);

        $driver->get($site->getBaseUrl().$this->path);
    }
}