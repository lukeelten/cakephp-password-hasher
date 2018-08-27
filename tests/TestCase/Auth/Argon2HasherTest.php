<?php

namespace lukeelten\PasswordHasherTest\Auth;

use lukeelten\PasswordHasherTest\Util\HasherTestUtil;
use lukeelten\PasswordHasher\Auth\Argon2Hasher;

class Argon2HasherTest extends HasherTestUtil
{

    protected static $className = Argon2Hasher::class;
}
