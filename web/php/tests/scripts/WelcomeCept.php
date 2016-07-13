<?php
  $I = new AcceptanceTester($scenario);
  $I->wantTo('Frontpage layout');
  $I->amOnPage('/');
  $I->see('Home');
  $I->see('Tracking');
  $I->see('Register');
?>
