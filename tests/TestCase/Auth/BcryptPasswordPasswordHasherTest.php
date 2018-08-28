<?php

namespace lukeelten\PasswordHasherTest\Auth;

use lukeelten\PasswordHasher\Auth\Argon2PasswordHasher;
use lukeelten\PasswordHasher\Auth\BcryptPasswordHasher;

/**
 * Class BcryptPasswordPasswordHasherTest
 * @package lukeelten\PasswordHasherTest\Auth
 *
 * @author Tobias Derksen <tobias@nulap.com>
 */
class BcryptPasswordPasswordHasherTest extends PasswordHasherTestBase
{

    protected static $className = BcryptPasswordHasher::class;

    public function testRehash2()
    {
        $password = $this->randomPassword();
        $instance = $this->getInstance();

        $instance2 = new Argon2PasswordHasher();
        $hash = $instance2->hash($password);

        $this->assertTrue($instance->needsRehash($hash));
    }
}
