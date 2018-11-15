<?php

namespace Framework\Ability\BrowseWebsite;

use Facebook\WebDriver\WebDriverBy;

class LocatorMapper
{
    public function map($locator): WebDriverBy
    {
        if (is_array($locator)) {
            if (array_key_exists('css', $locator)) {
                return WebDriverBy::cssSelector($locator['css']);
            }
        }

        throw new \InvalidArgumentException(sprintf('Unrecognized locator "%s"', print_r($locator, true)));
    }
}