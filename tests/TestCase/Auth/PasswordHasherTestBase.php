<?php

namespace lukeelten\PasswordHasherTest\Auth;

use Cake\Auth\AbstractPasswordHasher;
use Cake\TestSuite\TestCase;

class PasswordHasherTestBase extends TestCase
{

    /**
     * @var string Classname of class under test
     */
    protected static $className;

    protected function getInstance() : AbstractPasswordHasher
    {
        $instance = new static::$className();
        $this->assertNotNull($instance);

        return $instance;
    }

    protected function randomPassword($length = 64) : string
    {
        return bin2hex(random_bytes($length));
    }

    public function testInstance()
    {
        $instance = $this->getInstance();
        $this->assertInstanceOf(AbstractPasswordHasher::class, $instance);
    }

    public function testHash()
    {
        $password = $this->randomPassword();
        $instance = $this->getInstance();

        $hashed = $instance->hash($password);
        $this->assertNotEmpty($hashed);

        $hashed2 = $instance->hash($password);
        // Next hash should generate new salt resulting in new hash
        $this->assertNotEquals($hashed, $hashed2);
        // Nevertheless string length should be equal
        $this->assertEquals(strlen($hashed), strlen($hashed2));
    }

    public function testCheck()
    {
        $password = $this->randomPassword();
        $instance = $this->getInstance();

        $hashed = $instance->hash($password);
        $this->assertTrue($instance->check($password, $hashed));
        $this->assertFalse($instance->check("abc", $hashed));
        $this->assertFalse($instance->check($password, "ököajdjhsfliuasnfd"));
        $this->assertFalse($instance->check("ököajdjhsfliuasnfd", "ököajdjhsfliuasnfd"));
    }

    public function testRehash()
    {
        $password = $this->randomPassword();
        $instance = $this->getInstance();

        $hashed = $instance->hash($password);
        $this->assertFalse($instance->needsRehash($hashed));
    }
}
