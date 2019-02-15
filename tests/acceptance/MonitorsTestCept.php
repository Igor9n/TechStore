<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('Check that we see one product');
$I->amOnPage('/category/view?id=monitor');
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
$I->see('Monitor 27\'\' MSI Optix MAG27C');
