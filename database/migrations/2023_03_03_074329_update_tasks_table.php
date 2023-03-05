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
        Schema::table('tasks', function (Blueprint $table) {
            $table->text('description')->nullable();
            $table->integer('status_id')->nullable();
            $table->integer('created_by_id')->nullable();
            $table->integer('assigned_to_id')->nullable();
            $table->foreign('assigned_to_id')
                ->references('id')
                ->on('users');
        });
        // такой странный порядок нужен для обхода бага тестирования с SQLite (см. заметку в Evernote)
        Schema::table('tasks', function (Blueprint $table) {
            $table->integer('status_id')->nullable(false)->change();
            $table->foreign('status_id')
                ->references('id')
                ->on('task_statuses');
            $table->integer('created_by_id')->nullable(false)->change();
            $table->foreign('created_by_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('status_id');
            $table->dropColumn('created_by_id');
            $table->dropColumn('assigned_to_id');
        });
    }
};
