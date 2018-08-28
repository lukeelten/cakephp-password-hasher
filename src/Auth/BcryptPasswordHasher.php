<?php

namespace lukeelten\PasswordHasher\Auth;

use Cake\Auth\DefaultPasswordHasher;

/**
 * Class BcryptHasher
 * @package lukeelten\PasswordHasher\Auth
 *
 * @author Tobias Derksen <tobias@nulap.com>
 */
class BcryptPasswordHasher extends DefaultPasswordHasher
{

    protected $_defaultConfig = [
        'hashType' => PASSWORD_BCRYPT,
        'hashOptions' => []
    ];
}
