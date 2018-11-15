<?php

namespace Framework\Action;

use Framework\Ability\BrowseWebsite;
use Framework\Actor\ActorInterface;
use Framework\PerformableInterface;

class Click implements PerformableInterface
{
    private $locator;

    public function __construct($locator)
    {
        $this->locator = $locator;
    }

    public function performAs(ActorInterface $actor): void
    {
        /** @var BrowseWebsite $browseWebsite */
        $browseWebsite = $actor->ableTo('browseWebsite');

        $driver = $browseWebsite->getDriver();
        $locatorMapper = $browseWebsite->getLocatorMapper();

        $element = $driver->findElement($locatorMapper->map($this->locator));
        $element->click();
    }
}