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
        Schema::create('subscripes', function (Blueprint $table) {
            $table->id();
              $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users') ->onUpdate('cascade');          
            $table->unsignedBigInteger('pack_id');
            $table->foreign('pack_id')->references('id')->on('packs') ->onUpdate('cascade'); 
            $table->string('pack_title')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('price')->nullable();
            $table->string('end_at')->nullable();
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
        Schema::dropIfExists('subscripes');
    }
};
