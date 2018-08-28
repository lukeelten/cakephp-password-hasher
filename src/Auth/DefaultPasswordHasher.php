<?php

namespace lukeelten\PasswordHasher\Auth;

use Cake\Auth\DefaultPasswordHasher as CakeDefaultPasswordHasher;

class DefaultPasswordHasher extends CakeDefaultPasswordHasher
{

    protected $_defaultConfig = [
        'hashType' => PASSWORD_DEFAULT,
        'hashOptions' => []
    ];
}
