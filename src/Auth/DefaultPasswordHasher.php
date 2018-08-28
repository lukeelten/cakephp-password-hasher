<?php

namespace lukeelten\PasswordHasher\Auth;

use Cake\Auth\DefaultPasswordHasher as CakeDefaultPasswordHasher;

/**
 * Class DefaultPasswordHasher
 * @package lukeelten\PasswordHasher\Auth
 *
 * @author Tobias Derksen <tobias@nulap.com>
 */
class DefaultPasswordHasher extends CakeDefaultPasswordHasher
{

    protected $_defaultConfig = [
        'hashType' => PASSWORD_DEFAULT,
        'hashOptions' => []
    ];
}
