<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AdminPhotoProfile;
use App\Services\Admin\HandleImage;

class DeleteUnacceptedPhotos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'photo:remove';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove unaccepted photos from admin photo profile table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(HandleImage $handleImage)
    {
        $adminPhotos = AdminPhotoProfile::select(['id', 'path'])
                                    ->where('accepted', 0)
                                    ->get();

        $handleImage->removeImages(
            $adminPhotos->pluck('path')
            ->toArray()
        );

        $rows = AdminPhotoProfile::destroy(
            $adminPhotos->pluck('id')
            ->toArray()
        );

        return $rows;
    }
}
