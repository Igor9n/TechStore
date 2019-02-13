<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('Check that we see processors');
$I->amOnPage('/category/view?id=processor');
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
$I->see('Intel Core i3');
$I->see('AMD Ryzen 5 2600X');
$I->see('AMD Ryzen 7 1700');
