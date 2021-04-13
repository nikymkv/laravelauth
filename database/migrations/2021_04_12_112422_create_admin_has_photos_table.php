<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminHasPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_has_photos', function (Blueprint $table) {
            $table->foreignId('admin_id')->constrained('admins');
            $table->foreignId('admin_photo_id')->constrained('admin_photo_profiles')->onDelete('cascade');

            $table->unique(['admin_id', 'admin_photo_id']);

            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_has_photos');
    }
}
