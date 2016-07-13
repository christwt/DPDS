<?php
  $I = new AcceptanceTester($scenario);
  $I->wantTo('Place and order');
  $I->amOnPage('/');
  $I->fillField('user', 'WTC');
  $I->fillField('pass', 'password');
  $I->click('Login');
  $I->submitForm('#order', [
  'address' => '1111 Engineering Dr',
  'city' => 'Boulder',
  'state' => 'Colorado',
  'weight' => '2']);
  $I->see('Click here to go back.');
?>
