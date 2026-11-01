<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Creates the "tasks" table inside the todo_app database.
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            // id: primary key, auto-increment number for each task
            $table->id();

            // title: the short name of the task (max 255 characters)
            $table->string('title');

            // description: longer details, allowed to be empty (nullable)
            $table->text('description')->nullable();

            // status: 0 = Pending, 1 = Completed. Default is 0 (Pending)
            $table->boolean('status')->default(0);

            // created_at and updated_at: timestamps added automatically by Laravel
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * Drops the table when running "php artisan migrate:rollback".
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
