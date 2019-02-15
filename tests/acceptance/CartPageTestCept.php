<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('Check empty cart');
$I->amOnPage('/cart/view');
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
$I->see('Your cart is empty');
$I->see('You haven\'t ordered anything yet');
