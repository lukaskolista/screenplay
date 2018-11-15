<?php

namespace Framework\Action;

use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Framework\Ability\BrowseWebsite;
use Framework\Actor\ActorInterface;
use Framework\PerformableInterface;

class WaitForElement implements PerformableInterface
{
    /**
     * @var WebDriverBy
     */
    private $locator;

    public function __construct(WebDriverBy $locator)
    {
        $this->locator = $locator;
    }

    public function performAs(ActorInterface $actor): void
    {
        /** @var BrowseWebsite $browseWebsite */
        $browseWebsite = $actor->ableTo('browseWebsite');

        $driver = $browseWebsite->getDriver();
        $locatorMapper = $browseWebsite->getLocatorMapper();

        $driver->wait()->until(
            WebDriverExpectedCondition::presenceOfElementLocated(
                $this->locator
            )
        );
    }
}