<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy extends ModelPolicy
{
    use HandlesAuthorization;

    protected function getModelClass() : string
    {
        return Admin::class;
    }
}
