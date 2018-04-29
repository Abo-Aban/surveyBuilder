<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('survey_id')->nullable()->unsigned();
            $table->mediumText('question');
            $table->string('question_type'); // mcq, scq
            $table->integer('alters_count')->default(0);
            $table->string('alter_1')->nullable();
            $table->string('alter_2')->nullable();
            $table->string('alter_3')->nullable();
            $table->string('alter_4')->nullable();
            $table->string('alter_5')->nullable();

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
        Schema::dropIfExists('questions');
    }
}
