<?php

namespace lukeelten\PasswordHasher\Auth;

use Cake\Auth\DefaultPasswordHasher as CakeDefaultPasswordHasher;

/**
 * Class DefaultPasswordHasher
 * Use PASSWORD_DEFAULT for password hashing.
 * By now, this class provides the same functionality as the CakePHP built-in DefaultPasswordHasher.
 *
 * @package lukeelten\PasswordHasher\Auth
 * @since 1.0.0
 * @author Tobias Derksen <tobias@nulap.com>
 * @license https://opensource.org/licenses/mit-license.php MIT License
 */
class DefaultPasswordHasher extends CakeDefaultPasswordHasher
{

    /**
     * @var array Override default config
     */
    protected $_defaultConfig = [
        'hashType' => PASSWORD_DEFAULT,
        'hashOptions' => []
    ];
}
