<?php

namespace lukeelten\PasswordHasherTest\Auth;

use lukeelten\PasswordHasher\Auth\Argon2PasswordHasher;
use lukeelten\PasswordHasher\Auth\BcryptPasswordHasher;

/**
 * Class Argon2PasswordPasswordHasherTest
 * @package lukeelten\PasswordHasherTest\Auth
 *
 * @author Tobias Derksen <tobias@nulap.com>
 */
class Argon2PasswordHasherTest extends PasswordHasherTestBase
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
