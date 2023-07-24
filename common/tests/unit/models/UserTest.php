<?php

use Yii;

use common\models\User;
use yii\test\ActiveFixture;

class UserTest extends \PHPUnit\Framework\TestCase
{
    protected function setUp(): void
    {
        // Yii2 bootstrap, you may need to adjust this according to your setup
        \Yii::setAlias('@common', dirname(__DIR__));
        $config = require(\Yii::getAlias('@common/config/main.php'));
        new \yii\console\Application($config);
    }

    protected function tearDown(): void
    {
        // Clean up the database after each test
        User::deleteAll();
    }

    public function testFindIdentity()
    {
        $user = new User();
        $user->username = 'testuser';
        $user->status = User::STATUS_ACTIVE;
        $user->save();

        $foundUser = User::findIdentity($user->id);

        $this->assertInstanceOf(User::class, $foundUser);
        $this->assertEquals($user->id, $foundUser->getId());
    }

    public function testFindByUsername()
    {
        $user = new User();
        $user->username = 'testuser';
        $user->status = User::STATUS_ACTIVE;
        $user->save();

        $foundUser = User::findByUsername('testuser');

        $this->assertInstanceOf(User::class, $foundUser);
        $this->assertEquals($user->id, $foundUser->getId());
    }

    public function testValidatePassword()
    {
        $password = 'testpassword';

        $user = new User();
        $user->username = 'testuser';
        $user->status = User::STATUS_ACTIVE;
        $user->setPassword($password);
        $user->save();

        $this->assertTrue($user->validatePassword($password));
        $this->assertFalse($user->validatePassword('wrongpassword'));
    }

    // Add more test cases for other methods as needed
}
