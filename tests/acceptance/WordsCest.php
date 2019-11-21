<?php

class WordsCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->amOnPage('/');

        $I->see('Главная');
        $I->see('Перевести');
        $I->fillField('en', 'hello');
        $I->click('Перевести');
        $I->see('Здравствуйте');
    }
}
