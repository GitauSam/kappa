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
        Schema::create('service_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ussd_session_id');
            $table->foreign('ussd_session_id')
                ->references('id')
                ->on('ussd_sessions');
            $table->string('user_email')->nullable();
            $table->string('user_name')->nullable();
            $table->bigInteger('user_national_id')->nullable();
            $table->unsignedBigInteger('event_id')->nullable();
            $table->smallInteger('status')->default(0);
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
        Schema::dropIfExists('service_requests');
    }
};
