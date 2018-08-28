<?php

namespace lukeelten\PasswordHasher\Auth;

use Cake\Auth\DefaultPasswordHasher;

/**
 * Class BcryptHasher
 * @package lukeelten\PasswordHasher\Auth
 */
class BcryptPasswordHasher extends DefaultPasswordHasher
{

    protected $_defaultConfig = [
        'hashType' => PASSWORD_BCRYPT,
        'hashOptions' => []
    ];
}
