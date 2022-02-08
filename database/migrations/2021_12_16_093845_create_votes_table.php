<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_election_id');
            $table->foreign('type_election_id')
            ->references('id')
            ->on('type_elections')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->string('name');
            $table->string('slug');
            $table->boolean('published')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->timestamp('date_debut');
            $table->timestamp('date_fin');
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
        Schema::dropIfExists('votes');
    }
}
