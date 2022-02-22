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
        Schema::create('ussd_menus', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('app_ussd_menu');
            $table->foreign('app_ussd_menu')
                ->references('id')
                ->on('app_ussd_menus');
            $table->string('menu_key');
            $table->string('next_menu_key');
            $table->string('previous_menu_key');
            $table->string('menu_text', 280);
            $table->smallInteger('is_final_menu')
                ->default(0);
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
        Schema::dropIfExists('ussd_menus');
    }
};
