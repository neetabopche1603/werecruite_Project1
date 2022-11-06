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
        Schema::create('schedulers', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('user_id');
            $table->tinyInteger('job_id');
            $table->mediumText('title')->nullable();;
            $table->string('admin_sche_date')->nullable();
            $table->string('user_sche_date')->nullable();
            $table->string('actual_sche_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedulers');
    }
};
