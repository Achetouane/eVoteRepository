<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('candidats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('partie_id');
            $table->foreign('partie_id')
            ->references('id')
            ->on('parties')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->string('image');
            $table->string('name');
            $table->string('slug');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->boolean('presented')->default(false);
            $table->timestamp('presented_at')->nullable();
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
        Schema::dropIfExists('candidats');
    }
    
}
