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
       
            Schema::create('option_pack', function (Blueprint $table) {

            $table->unsignedBigInteger('option_id');
            $table->unsignedBigInteger('pack_id');
            $table->primary(['option_id','pack_id']);
            $table->foreign('option_id')->references('id')->on('options')
                ->onDelete('cascade')->onUpdate('cascade');
             $table->foreign('pack_id')->references('id')->on('packs')
                ->onDelete('cascade')->onUpdate('cascade');



        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
