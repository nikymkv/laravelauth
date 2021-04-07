<?php

namespace App\Observers;

use App\Models\Admin;

class AdminObserver
{
    /**
     * Handle the Admin "creating" event.
     *
     * @param  \App\Models\Admin  $admin
     * @return void
     */
    public function creating(Admin $admin)
    {
        $this->hashPassword($admin);
    }

    /**
     * Handle the Admin "created" event.
     *
     * @param  \App\Models\Admin  $admin
     * @return void
     */
    public function created(Admin $admin)
    {
        //
    }

    /**
     * Handle the Admin "updating" event.
     *
     * @param  \App\Models\Admin  $admin
     * @return void
     */
    public function updating(Admin $admin)
    {
        if ($admin->isDirty('password')) {
            $this->hashPassword($admin);
        }
    }

    /**
     * Handle the Admin "updated" event.
     *
     * @param  \App\Models\Admin  $admin
     * @return void
     */
    public function updated(Admin $admin)
    {
        // 
    }

    /**
     * Handle the Admin "deleted" event.
     *
     * @param  \App\Models\Admin  $admin
     * @return void
     */
    public function deleted(Admin $admin)
    {
        //
    }

    /**
     * Handle the Admin "restored" event.
     *
     * @param  \App\Models\Admin  $admin
     * @return void
     */
    public function restored(Admin $admin)
    {
        //
    }

    /**
     * Handle the Admin "force deleted" event.
     *
     * @param  \App\Models\Admin  $admin
     * @return void
     */
    public function forceDeleted(Admin $admin)
    {
        //
    }

    protected function hashPassword($admin)
    {
        $admin->password = \Hash::make($admin->password);
    }
}
