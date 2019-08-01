<?php

namespace Ramvel\Multiauth\Policies;

use App\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    public function isSuperAdmin(Admin $admin)
    {
        return in_array('super', $admin->roles->pluck('name')->toArray());
    }
}
