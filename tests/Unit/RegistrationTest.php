<?php

namespace Ramivel\Multiauth\Tests\Unit;

use Ramivel\Multiauth\Notifications\RegistrationNotification;
use Ramivel\Multiauth\Tests\TestCase;
use Illuminate\Support\Facades\Notification;

class RegistrationTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_send_register_notification()
    {
        Notification::fake();
        $admin = $this->createAdmin();
        $admin->notify(new RegistrationNotification('fakePassword'));
        Notification::assertSentTo([$admin], RegistrationNotification::class);
    }
}
