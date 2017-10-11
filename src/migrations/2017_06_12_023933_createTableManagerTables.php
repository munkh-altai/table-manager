<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableManagerTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('language');
            $table->string('flag');
        });

        Schema::create('static_words', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key');
            $table->text('translation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locales');
        Schema::dropIfExists('static_words');
    }
}
