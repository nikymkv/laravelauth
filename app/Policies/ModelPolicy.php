<?php

namespace App\Policies;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Access\HandlesAuthorization;

abstract class ModelPolicy
{
    use HandlesAuthorization;

    abstract protected function getModelClass() : string;

    public function viewAny(Model $user)
    {
        return $user->can('view-any-' . $this->getModelClass());
    }

    public function view(Model $user, Model $model)
    {
        return $user->can('view-' . $this->getModelClass());
    }

    public function create(Model $user)
    {
        return $user->can('create-' . $this->getModelClass());
    }

    public function update(Model $user, Model $model)
    {
        return $user->can('update-' . $this->getModelClass());
    }

    public function delete(Model $user, Model $model)
    {
        return $user->can('delete-' . $this->getModelClass());
    }
}
