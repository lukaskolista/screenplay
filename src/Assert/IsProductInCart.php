<?php

namespace Framework\Assert;

use Framework\Ability\BrowseWebsite\By;
use Framework\Action\OpenPage;
use Framework\Action\WaitForElement;
use Framework\Actor\ActorInterface;
use Framework\Question\HasCartItem;
use Webmozart\Assert\Assert;

class IsProductInCart implements AssertInterface
{
    /**
     * @var string
     */
    private $productName;

    public function __construct(string $productName)
    {
        $this->productName = $productName;
    }

    public function checkBy(ActorInterface $actor)
    {
        $actor->attemptsToActions(
            new OpenPage('/cart'),
            new WaitForElement(By::css('app-cart-item'))
        );
        $hasCartItem = $actor->asksFor(new HasCartItem($this->productName));

        Assert::true($hasCartItem, sprintf('Product "%s" not found in cart', $this->productName));
    }
}