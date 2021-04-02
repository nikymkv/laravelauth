<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Access\HandlesAuthorization;

abstract class ModelPolicy
{
    use HandlesAuthorization;

    abstract protected function getModelClass() : string;

    public function viewAny(User $user)
    {
        return $user->can('view-any-' . $this->getModelClass());
    }

    public function view(User $user, Post $model)
    {
        return $user->can('view-' . $this->getModelClass());
    }

    public function create(User $user)
    {
        return $user->can('create-' . $this->getModelClass());
    }

    public function update(User $user, Post $model)
    {
        return $user->can('update-' . $this->getModelClass());
    }

    public function delete(User $user, Post $model)
    {
        return $user->can('delete-' . $this->getModelClass());
    }
}
