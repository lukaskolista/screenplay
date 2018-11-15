<?php

namespace Framework\Action;

use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Framework\Ability\BrowseWebsite;
use Framework\Actor\ActorInterface;
use Framework\PerformableInterface;

class WaitForTextContains implements PerformableInterface
{
    /**
     * @var string
     */
    private $text;

    private $locator;

    public function __construct(string $text, $locator = null)
    {
        $this->text = $text;
        $this->locator = $locator;
    }

    public function performAs(ActorInterface $actor): void
    {
        /** @var BrowseWebsite $browseWebsite */
        $browseWebsite = $actor->ableTo('browseWebsite');

        $driver = $browseWebsite->getDriver();
        $locatorMapper = $browseWebsite->getLocatorMapper();
        $webDriverBy = $this->locator !== null
            ? $locatorMapper->map($this->locator)
            : WebDriverBy::cssSelector('body');

        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextContains(
                $webDriverBy,
                $this->text
            )
        );
    }
}