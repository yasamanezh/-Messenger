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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable();
            $table->string('show_in_header')->nullable();
            $table->string('show_in_footer')->nullable();
            $table->integer('sort')->nullable();
            $table->integer('parent')->nullable();
            $table->enum('type',['blog','weblog','post','page','home','faq','feature','work','pack','contact','about']);
            $table->tinyInteger('status')->dafault('0');
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
        Schema::dropIfExists('menus');
    }
};
