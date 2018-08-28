<?php

namespace lukeelten\PasswordHasherTest\Auth;

use lukeelten\PasswordHasher\Auth\DefaultPasswordHasher;

/**
 * Class DefaultPasswordPasswordHasherTest
 * @package lukeelten\PasswordHasherTest\Auth
 *
 * @author Tobias Derksen <tobias@nulap.com>
 */
class DefaultPasswordPasswordHasherTest extends PasswordHasherTestBase
{

    protected static $className = DefaultPasswordHasher::class;
}
