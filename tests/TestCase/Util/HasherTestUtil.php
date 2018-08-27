<?php

namespace lukeelten\PasswordHasherTest\Util;

use Cake\Auth\AbstractPasswordHasher;
use Cake\TestSuite\TestCase;

class HasherTestUtil extends TestCase
{

    protected static $className;

    public function testInstance()
    {
        $instance = new static::$className();
        $this->assertNotNull($instance);

        $this->assertInstanceOf(AbstractPasswordHasher::class, $instance);
    }

    public function testHash()
    {
        $password = bin2hex(random_bytes(32));
        $instance = new static::$className();

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
        $password = bin2hex(random_bytes(32));
        $instance = new static::$className();

        $hashed = $instance->hash($password);
        $this->assertTrue($instance->check($password, $hashed));
        $this->assertFalse($instance->check("abc", $hashed));
    }

    public function testRehash()
    {
        $password = bin2hex(random_bytes(32));
        $instance = new static::$className();

        $hashed = $instance->hash($password);
        $this->assertFalse($instance->needsRehash($hashed));
    }
}
