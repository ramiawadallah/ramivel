<?php

namespace Ramivel\Multiauth\Tests\Unit;

use Ramivel\Multiauth\Model\Role;
use Ramivel\Multiauth\Model\Admin;
use Ramivel\Multiauth\Tests\TestCase;
use Ramivel\Multiauth\Model\Permission;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PermissionTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_belongs_to_many_role()
    {
        $role        = factory(Role::class, 2)->create();
        $permission  = factory(Permission::class)->create();
        $permission->roles()->attach($role->pluck('id'));
        $this->assertInstanceOf(Role::class, $permission->roles->first());
    }

    /** @test */
    public function it_belongs_many_to_admin()
    {
        $admin       = factory(Admin::class)->create();
        $permission  = factory(Permission::class)->create();
        $permission->admins()->attach($admin->pluck('id'));
        $this->assertInstanceOf(Admin::class, $permission->admins->first());
    }
}
