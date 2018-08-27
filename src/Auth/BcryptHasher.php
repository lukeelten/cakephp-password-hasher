<?php

namespace lukeelten\PasswordHasher\Auth;

use Cake\Auth\DefaultPasswordHasher;

class BcryptHasher extends DefaultPasswordHasher {

    protected $_defaultConfig = [
        'hashType' => PASSWORD_BCRYPT,
        'hashOptions' => []
    ];

}