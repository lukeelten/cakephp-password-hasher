<?php

namespace lukeelten\PasswordHasher\Auth;

use Cake\Auth\DefaultPasswordHasher;


class DefaultHasher extends DefaultPasswordHasher {

    protected $_defaultConfig = [
        'hashType' => PASSWORD_DEFAULT,
        'hashOptions' => []
    ];

}