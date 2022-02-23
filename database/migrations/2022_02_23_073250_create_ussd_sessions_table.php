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
        Schema::create('ussd_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('ussd_code', 50);
            $table->string('ussd_msisdn', 30);
            $table->string('response_message', 2800);
            $table->string('current_ussd_menu_key')->nullable();
            $table->foreign('current_ussd_menu_key')
                ->references('menu_key')
                ->on('ussd_menus');
            $table->string('next_ussd_menu_key')->nullable();
            $table->foreign('next_ussd_menu_key')
                ->references('menu_key')
                ->on('ussd_menus');
            $table->string('previous_ussd_menu_key')->nullable();
            $table->foreign('previous_ussd_menu_key')
                ->references('menu_key')
                ->on('ussd_menus');
            $table->smallInteger('status')->default(1);
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
        Schema::dropIfExists('ussd_sessions');
    }
};
