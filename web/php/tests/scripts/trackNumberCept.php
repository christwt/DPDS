<?php
  $I = new AcceptanceTester($scenario);
  $I->wantTo('Track a order number');
  $I->amOnPage('/tracking_v2.php');
  $I->fillField('OrderId', '121111');
  $I->click('submit');
  $I->seeInCurrentUrl('/tracking_v2.php');
?>
