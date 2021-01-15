<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBotsmanagerTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bots', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('logic_id')->default(0);
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->text('data')->nullable();
            $table->timestamps();
        });
        Schema::create('bots_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bot_id')->default(0);
            $table->string('platform_name')->nullable();
            $table->string('platform_id')->nullable();
            $table->string('name')->nullable();
            $table->text('data')->nullable();
            $table->text('data_session')->nullable();
            $table->index(['bot_id']);
            $table->index(['platform_name', 'platform_id']);
            $table->timestamps();
        });
        Schema::create('bots_logic', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->text('data')->nullable();
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
        Schema::dropIfExists('bots');
        Schema::dropIfExists('bots_users');
        Schema::dropIfExists('bots_logic');
    }
}
