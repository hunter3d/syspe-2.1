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
        Schema::create('answeroptions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('questionnaire_id');
            $table->string('answer_uk');
            $table->string('answer_ru');
            $table->string('answer_en');
            $table->integer('order')->default(1);
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
        Schema::dropIfExists('answeroptions');
    }
};
