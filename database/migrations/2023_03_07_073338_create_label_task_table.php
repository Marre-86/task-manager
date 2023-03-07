<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('label_task', function (Blueprint $table) {
            $table->primary(['label_id','task_id']);
            $table->integer('task_id')->unsigned();
            $table->integer('label_id')->unsigned();
            $table->foreign('task_id')->references('id')->on('tasks');
            $table->foreign('label_id')->references('id')->on('labels');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('label_task');
    }
};
