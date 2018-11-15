<?php

namespace Framework\Task;

use Framework\Ability\BrowseWebsite\By;
use Framework\Action\Click;
use Framework\Action\OpenPage;
use Framework\Action\Wait;
use Framework\Action\WaitForElement;
use Framework\Action\WaitForTextContains;
use Framework\Actor\ActorInterface;
use Framework\PerformableInterface;

class AddProductToCart implements PerformableInterface
{
    /**
     * @var int
     */
    private $productId;

    public function __construct(int $productId)
    {
        $this->productId = $productId;
    }

    public function performAs(ActorInterface $actor): void
    {
        $actor->attemptsToActions(
            new OpenPage('/akcesoria/torebki/asymetryczna_torebka_kopertowa_koralowa'),
            new WaitForElement(By::css('app-product-form')),
            new Wait(3),
            new Click(['css' => 'app-product-form button']),
            new WaitForTextContains('Zobacz koszyk i złóż zamówienie', ['css' => 'app-product-form'])
        );
    }
}