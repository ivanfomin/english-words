<?php

class ExampleTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testUser()
    {
        $user = new \App\Models\User();
        $user->login = 'test123';
        $user->email = 'test123@mail.ru';
        $user->token = 123;
        $user->role = 1;
        $user->password = password_hash('password', PASSWORD_DEFAULT);;
        $user->save();

        $this->assertFalse(\App\Models\User::findByEmail('test12312@mail.ru'));
        $this->assertInstanceOf(\App\Models\User::class, \App\Models\User::findByEmail('test123@mail.ru'));
        $this->assertInstanceOf(\App\Models\User::class, \App\Models\User::findByLog('test123'));
        $this->assertInstanceOf(\App\Models\User::class, \App\Models\User::findByToken(123));

    }

    public function testWord()
    {
        $word = new \App\Models\Word();
        $word->ru = 'привет';
        $word->en = 'hi';
        $word->save();

        $this->assertInstanceOf(\App\Models\Word::class, \App\Models\Word::findByWord('hi'));
    }
}