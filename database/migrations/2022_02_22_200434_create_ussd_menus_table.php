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
            $table->unsignedBigInteger('app_ussd_menu');
            $table->foreign('app_ussd_menu')
                ->references('id')
                ->on('app_ussd_menus');
            $table->string('menu_key', 180)->unique();
            $table->string('next_menu_key', 180)->nullable();
            $table->string('previous_menu_key', 180)->nullable();
            $table->string('menu_text', 280);
            $table->string('menu_action', 200)->nullable();
            $table->string('menu_session_field', 200)->nullable();
            $table->smallInteger('is_final_menu')
                ->default(0);
            $table->smallInteger('is_parent')->nullable();
            $table->smallInteger('is_interactive')->default(0);
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
        Schema::dropIfExists('ussd_menus');
    }
};
