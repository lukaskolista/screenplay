<?php

namespace Framework\Ability;

use Facebook\WebDriver\WebDriver;
use Framework\Ability\BrowseWebsite\LocatorMapper;
use Framework\Ability\BrowseWebsite\Site;

class BrowseWebsite implements AbilityInterface
{
    /**
     * @var LocatorMapper
     */
    private $locatorMapper;

    /**
     * @var array
     */
    private $drivers;

    /**
     * @var array
     */
    private $sites;

    public function __construct(LocatorMapper $locatorMapper, array $drivers, array $sites)
    {
        $this->locatorMapper = $locatorMapper;
        $this->drivers = $drivers;
        $this->sites = $sites;
    }

    public function getName(): string
    {
        return 'browseWebsite';
    }

    public function getLocatorMapper(): LocatorMapper
    {
        return $this->locatorMapper;
    }

    public function getDriver(string $name = 'default'): WebDriver
    {
        return $this->drivers[$name];
    }

    public function getSite(string $name = 'default'): Site
    {
        /** @var Site $site */
        foreach ($this->sites as $site) {
            if ($site->getName() === $name) {
                return $site;
            }
        }

        throw new \InvalidArgumentException(sprintf('Site "%s" does not exist', $name));
    }
}