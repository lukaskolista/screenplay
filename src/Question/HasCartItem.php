<?php

namespace Framework\Question;

use Facebook\WebDriver\Exception\NoSuchElementException;
use Facebook\WebDriver\WebDriverBy;
use Framework\Ability\BrowseWebsite;
use Framework\Actor\ActorInterface;

class HasCartItem implements QuestionInterface
{
    /**
     * @var string
     */
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function answeredBy(ActorInterface $actor)
    {
        /** @var BrowseWebsite $browseWebsite */
        $browseWebsite = $actor->ableTo('browseWebsite');
        $driver = $browseWebsite->getDriver();

        $items = $driver->findElements(WebDriverBy::tagName('app-cart-item'));
        foreach ($items as $item) {
            try {
                $item->findElement(WebDriverBy::xpath('//*[contains(text(), \''.$this->name.'\')]'));

                return true;
            } catch (NoSuchElementException $e) {}
        }

        return false;
    }
}