<?php

namespace lukeelten\PasswordHasherTest\Auth;

use lukeelten\PasswordHasherTest\Util\HasherTestUtil;
use lukeelten\PasswordHasher\Auth\DefaultHasher;

/**
 * Class RecaptchaComponentTest
 * @author Tobias Derksen <tobias@nulap.com>
 */
class DefaultHasherTest extends HasherTestUtil
{

    protected static $className = DefaultHasher::class;
}
