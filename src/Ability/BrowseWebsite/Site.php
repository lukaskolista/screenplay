<?php

namespace Framework\Ability\BrowseWebsite;

class Site
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $baseUrl;

    public function __construct(string $name, string $baseUrl)
    {
        $this->name = $name;
        $this->baseUrl = $baseUrl;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }
}