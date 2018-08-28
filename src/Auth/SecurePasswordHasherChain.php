<?php

namespace lukeelten\PasswordHasher\Auth;

use Cake\Auth\FallbackPasswordHasher;

/**
 * Class SecurePasswordHasherChain
 *
 * Class allows you to seamlessly switch to a more modern password hashing algorithm by still allowing user to login
 * with their old password. The chain will indicate an old password when calling "needsRehash" on an old hashed password.
 * The password hasher provided first will used as default one for hashing new passwords, the other one will be checked
 * when verifying a password one-by-one whether they can verify the password or not.
 *
 * @package lukeelten\PasswordHasher\Auth
 * @since 1.0.0
 * @author Tobias Derksen <tobias@nulap.com>
 * @license https://opensource.org/licenses/mit-license.php MIT License
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
            // Add password hashers to configuration
            // Base class instantiates the concrete classes afterwards
            $config["hashers"] = [
                Argon2PasswordHasher::class,
                DefaultPasswordHasher::class,
                BcryptPasswordHasher::class
            ];
        }

        // Call baseclass constructure
        parent::__construct($config);
    }
}
