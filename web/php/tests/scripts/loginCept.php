<?php
  $I = new AcceptanceTester($scenario);
  $I->wantTo('Login');
  $I->amOnPage('/');
  $I->fillField('user', 'WTC');
  $I->fillField('pass', 'password');
  $I->click('Login');
  $I->seeInCurrentUrl('/clientHome.php');
?>
