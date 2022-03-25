<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_task_id')->unsigned()->nullable();
            $table->string('task');
            $table->string('note')->nullable();
            $table->integer('order');
            $table->enum('status', ['Incomplete', 'Complete'])->default('Incomplete');
            $table->timestamp('due')->nullable();
            $table->timestamp('completion')->nullable();
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
        Schema::dropIfExists('tasks');
    }
}
