<?php

namespace lukeelten\PasswordHasher\Auth;

use Cake\Auth\FallbackPasswordHasher;

/**
 * Class SecurePasswordHasherChain
 * @package lukeelten\PasswordHasher\Auth
 *
 * @author Tobias Derksen <tobias@nulap.com>
 */
class SecurePasswordHasherChain extends FallbackPasswordHasher
{

    /**
     * SecureHasherChain constructor.
     * @param array $config Initial configuration
     */
    public function __construct(array $config = [])
    {
        if (!array_key_exists("hashers", $config)) {
            $config["hashers"] = [
                Argon2PasswordHasher::class,
                DefaultPasswordHasher::class,
                BcryptPasswordHasher::class
            ];
        }

        parent::__construct($config);
    }
}
