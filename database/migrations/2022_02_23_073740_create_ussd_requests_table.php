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
        Schema::create('ussd_requests', function (Blueprint $table) {
            $table->id();
            $table->string('user_input', 200)->nullable();
            $table->unsignedBigInteger('ussd_session_id');
            $table->foreign('ussd_session_id')
                ->references('id')
                ->on('ussd_sessions');
            $table->string('ussd_menu_text', 280);
            $table->string('response_message', 2800);
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
        Schema::dropIfExists('ussd_requests');
    }
};
