<?php

namespace Ramivel\Multiauth\Tests\Unit;

use Ramivel\Multiauth\Notifications\AdminResetPasswordNotification;
use Ramivel\Multiauth\Tests\TestCase;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class AdminTest extends TestCase
{
    /**
     * @test
     */
    public function an_admin_can_have_many_role()
    {
        $admin = $this->createAdmin();
        $this->assertInstanceOf(BelongsToMany::class, $admin->roles());
    }

    /**
     * @test
     */
    public function it_can_bcrypt_the_password()
    {
        $admin = $this->createAdmin();
        $this->assertTrue(Hash::check('secret123', $admin->password));
    }

    /**
     * @test
     */
    public function it_can_send_password_reset_notification()
    {
        Notification::fake();
        $admin = $this->createAdmin();
        $admin->sendPasswordResetNotification('fakeToken');
        Notification::assertSentTo([$admin], AdminResetPasswordNotification::class);
    }
}
