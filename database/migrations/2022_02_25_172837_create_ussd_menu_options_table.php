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
        Schema::create('ussd_menu_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ussd_menu_id');
            $table->foreign('ussd_menu_id')
                    ->references('id')
                    ->on('ussd_menus');
            $table->string('option_menu_key', 180)->unique();
            $table->string('option_menu_text', 280);
            $table->string('option_menu_action', 200)->nullable();
            $table->string('option_menu_session_field', 50)->nullable();
            $table->smallInteger('is_menu_option_interactive')->default(0);
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
        Schema::dropIfExists('ussd_menu_options');
    }
};
