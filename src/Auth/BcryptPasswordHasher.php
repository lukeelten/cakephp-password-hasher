<?php

namespace lukeelten\PasswordHasher\Auth;

use Cake\Auth\DefaultPasswordHasher;

/**
 * Class BcryptPasswordHasher
 *
 * Class enforces password hashing with bcrypt hashing algorithm.
 * Bcrypt is currently the default algorithm for PHP password_hash, nevertheless, it is likely to change in the future
 * due to the implementation of Argon2i.
 * If you want to stick to bcrypt, use this class.
 *
 * @package lukeelten\PasswordHasher\Auth
 * @since 1.0.0
 * @author Tobias Derksen <tobias@nulap.com>
 * @license https://opensource.org/licenses/mit-license.php MIT License
 */
class BcryptPasswordHasher extends DefaultPasswordHasher
{

    /**
     * @var array Override default config
     */
    protected $_defaultConfig = [
        'hashType' => PASSWORD_BCRYPT,
        'hashOptions' => []
    ];
}
