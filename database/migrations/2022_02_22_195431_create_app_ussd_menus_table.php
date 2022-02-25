<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_ussd_menus', function (Blueprint $table) {
            $table->id();
            $table->string('ussd_code', 50);
            $table->unsignedBigInteger('app_id');
            $table->foreign('app_id')
                ->references('id')
                ->on('apps');
            $table->string('root_menu_key', 180)
                ->nullable();
            $table->smallInteger('status');
            $table->string('created_by', 180)->default('admin');
            $table->string('updated_by', 180)->default('admin');
            $table->timestamps();
            $table->string('deleted_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_ussd_menus');
    }
};
