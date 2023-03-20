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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('visitor_id');
            $table->bigInteger('exhibition_id');
            $table->bigInteger('event_id');
            $table->string('number');
            $table->enum('pay_method',['promocode','card','invoice']);
            $table->bigInteger('promocode_id')->default(0);
            $table->bigInteger('currency_id')->default(1);
            $table->decimal('price',10,2);
            $table->enum('status',['new','complete','false']);
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
        Schema::dropIfExists('orders');
    }
};
