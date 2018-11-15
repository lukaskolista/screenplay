<?php

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Framework\Ability\BrowseWebsite;
use Framework\Ability\BrowseWebsite\LocatorMapper;
use Framework\Ability\BrowseWebsite\Site;
use Framework\ActorFactory;
use Framework\Event\AfterAbilityEvent;
use Framework\Event\AfterActionEvent;
use Framework\Event\AfterAssertEvent;
use Framework\Event\AfterQuestionEvent;
use Framework\Event\AfterTaskEvent;
use Framework\Event\BeforeAbilityEvent;
use Framework\Event\BeforeActionEvent;
use Framework\Event\BeforeAssertEvent;
use Framework\Event\BeforeQuestionEvent;
use Framework\Event\BeforeTaskEvent;
use Framework\Logger\MessageFactory;
use Framework\LogListener;
use Framework\Test;
use Monolog\Handler\PHPConsoleHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Symfony\Component\EventDispatcher\EventDispatcher;

require_once __DIR__ . '/vendor/autoload.php';

$driver = RemoteWebDriver::create('http://localhost:4444/wd/hub', DesiredCapabilities::chrome());
$driver->manage()->timeouts()->implicitlyWait(10);

$logger = new Logger('actor', [
    new StreamHandler('php://stdout')
]);
$messageFactory = new MessageFactory();
$listener = new LogListener($messageFactory, $logger);

$dispatcher = new EventDispatcher();
$dispatcher->addListener(BeforeTaskEvent::NAME, [$listener, 'onBeforeTask']);
$dispatcher->addListener(AfterTaskEvent::NAME, [$listener, 'onAfterTask']);
$dispatcher->addListener(BeforeActionEvent::NAME, [$listener, 'onBeforeAction']);
$dispatcher->addListener(AfterActionEvent::NAME, [$listener, 'onAfterAction']);
$dispatcher->addListener(BeforeQuestionEvent::NAME, [$listener, 'onBeforeQuestion']);
$dispatcher->addListener(AfterQuestionEvent::NAME, [$listener, 'onAfterQuestion']);
$dispatcher->addListener(BeforeAbilityEvent::NAME, [$listener, 'onBeforeAbility']);
$dispatcher->addListener(AfterAbilityEvent::NAME, [$listener, 'onAfterAbility']);
$dispatcher->addListener(BeforeAssertEvent::NAME, [$listener, 'onBeforeAssert']);
$dispatcher->addListener(AfterAssertEvent::NAME, [$listener, 'onAfterAssert']);

$actorFactory = new ActorFactory($dispatcher);
$browseWebsite = new BrowseWebsite(
    new LocatorMapper(),
    [
        'default' => $driver
    ],
    [
        new Site('default', 'http://app.2.cloud.mns.pl')
    ]
);

$test = new Test($actorFactory);

try {
    $test->addProductToCart($browseWebsite);
} finally {
    $driver->close();
}
