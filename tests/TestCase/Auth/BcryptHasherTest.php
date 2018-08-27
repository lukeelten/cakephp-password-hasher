<?php

namespace lukeelten\PasswordHasherTest\Auth;

use lukeelten\PasswordHasherTest\Util\HasherTestUtil;
use lukeelten\PasswordHasher\Auth\BcryptHasher;

class BcryptHasherTest extends HasherTestUtil
{

    protected static $className = BcryptHasher::class;
}
