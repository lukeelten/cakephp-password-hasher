<?php

namespace lukeelten\PasswordHasherTest\Auth;

use lukeelten\PasswordHasher\Auth\Argon2PasswordHasher;
use lukeelten\PasswordHasher\Auth\BcryptPasswordHasher;

class Argon2PasswordPasswordHasherTest extends PasswordHasherTestBase
{

    protected static $className = Argon2PasswordHasher::class;

    public function testRehash2()
    {
        $password = $this->randomPassword();
        $instance = $this->getInstance();

        $instance2 = new BcryptPasswordHasher();
        $hash = $instance2->hash($password);

        $this->assertTrue($instance->needsRehash($hash));
    }
}
