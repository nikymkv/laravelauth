<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy extends ModelPolicy
{
    protected function getModelClass() : string
    {
        return Post::class;
    }

    public function import(User $user)
    {
        return $user->can('import-' . $this->getModelClass());
    }

    public function export(User $user, Post $model)
    {
        return $user->can('export-' . $this->getModelClass());
    }
}
