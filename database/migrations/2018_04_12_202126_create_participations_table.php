<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('survey_id')->nullable()->unsigned();
            $table->integer('question_id')->nullable()->unsigned();
            $table->integer('alter');
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
        Schema::dropIfExists('participations');
    }
}
