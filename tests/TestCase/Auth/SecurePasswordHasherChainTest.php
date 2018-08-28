<?php

namespace lukeelten\PasswordHasherTest\Auth;

use lukeelten\PasswordHasher\Auth\Argon2PasswordHasher;
use lukeelten\PasswordHasher\Auth\BcryptPasswordHasher;
use lukeelten\PasswordHasher\Auth\SecurePasswordHasherChain;

/**
 * Class SecurePasswordHasherChainTest
 * @package lukeelten\PasswordHasherTest\Auth
 *
 * @author Tobias Derksen <tobias@nulap.com>
 */
class SecurePasswordHasherChainTest extends PasswordHasherTestBase
{

    protected static $className = SecurePasswordHasherChain::class;

    public function testChain()
    {
        $instance = new SecurePasswordHasherChain();

        $bcryptHasher = new BcryptPasswordHasher();
        $argonHasher = new Argon2PasswordHasher();

        $password = $this->randomPassword();

        $hash = $instance->hash($password);
        $this->assertTrue($instance->check($password, $hash));

        // Password should have been hashed with argon2
        $this->assertTrue($argonHasher->check($password, $hash));

        if (!defined("PASSWORD_ARGON2I")) {
            // Password should not have been hashed with bcrypt
            // But this can only be checked if password_verify does not support argon2
            $this->assertFalse($bcryptHasher->check($password, $hash));
        }

        // Hash with Bcrypt and check with chain
        $hash = $bcryptHasher->hash($password);
        $this->assertTrue($instance->check($password, $hash));
    }
}
