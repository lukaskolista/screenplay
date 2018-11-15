<?php

namespace Framework;

use Framework\Ability\BrowseWebsite;
use Framework\Assert\IsProductInCart;
use Framework\Task\AddProductToCart;

class Test extends AbstractTestCase
{
    public function addProductToCart(BrowseWebsite $browseWebsite)
    {
        $actor = $this->createActor('customer');
        $actor->can($browseWebsite);

        $actor->attemptsToTaks(new AddProductToCart(123));
        $actor->assertThat(new IsProductInCart('Asymetryczna torebka kopertowa Koralowa'));
    }
}