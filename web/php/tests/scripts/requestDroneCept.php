<?php
  $I = new AcceptanceTester($scenario);
  $I->wantTo('Place and order');
  $I->amOnPage('/');
  $I->fillField('user', 'WTC');
  $I->fillField('pass', 'password');
  $I->click('Login');
  $I->submitForm('#drone', [
  'verifyid' => 'WTC',
  'verifypass' => 'password',
  'drones' => '1']);
?>
