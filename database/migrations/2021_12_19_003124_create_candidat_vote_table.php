<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatVoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidat_vote', function (Blueprint $table) {
            $table->id(); $table->timestamps();
            $table->unsignedBigInteger('candidat_id');


            $table->foreign('candidat_id')
            ->references('id')
            ->on('candidats')
            ->onDelete('cascade')
            ->onUpdate('cascade');
           

            $table->unsignedBigInteger('vote_id');
            $table->foreign('vote_id')
            ->references('id')
            ->on('votes')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidat_vote');
    }
}
