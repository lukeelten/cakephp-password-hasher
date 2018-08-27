<?php
namespace lukeelten\PasswordHasherTest\Auth;

use Cake\TestSuite\TestCase;
use lukeelten\PasswordHasher\Auth\DefaultHasher;

/**
 * Class RecaptchaComponentTest
 * @author Tobias Derksen <tobias@nulap.com>
 */
class DefaultHasherTest extends TestCase
{

    public function testCreation()
    {
        $instance = new DefaultHasher();
        $this->assertNotNull($instance);
    }
}
