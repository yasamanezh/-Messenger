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
        Schema::create('module_options', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->integer('sort')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->enum('type',['feature','counter','client']);
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
        Schema::dropIfExists('module_options');
    }
};
