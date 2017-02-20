<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->bigIncrements('id');
            $table->string('channel', 50)->index();
            $table->string('level',   50)->index();
            $table->string('level_name', 100);
            $table->text('message');
            $table->text('context');

            $table->integer('remote_addr')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('session_id')->nullable();
            $table->integer('created_by')->index()->nullable();

            $table->dateTime('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('logs');
    }
}
