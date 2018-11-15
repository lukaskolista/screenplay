<?php

namespace Framework\Ability\BrowseWebsite;

use Facebook\WebDriver\WebDriverBy;

class By
{
    public static function css(string $css): WebDriverBy
    {
        return WebDriverBy::cssSelector($css);
    }
}