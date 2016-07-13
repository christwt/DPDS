<?php
  $I = new AcceptanceTester($scenario);
  $I->wantTo('Register as a user');
  $I->amOnPage('/register.php');
  $I->fillField('name', 'Paul-Robert Laliberte');
  $I->fillField('user', 'CSCI');
  $I->fillField('address', '836 Exmoor Rd.');
  $I->fillField('pass', 'idk');
  $I->click('submit');
?>
