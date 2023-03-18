<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create( 'events', function ( Blueprint $table ) {
            $table->id();
            $table->bigInteger('exhibition_id');
            $table->string('name_uk');
            $table->string('name_ru');
            $table->string('name_en');
            $table->string('description_uk');
            $table->string('description_ru');
            $table->string('description_en');
            $table->string('location_uk')->nullable();
            $table->string('location_ru')->nullable();
            $table->string('location_en')->nullable();
            $table->string('logo_path')->nullable();
            $table->string('logo_name')->nullable();
            $table->string('ticket_temp_path')->nullable();
            $table->string('ticket_temp_name')->nullable();
            $table->string('start');
            $table->string('stop');
            $table->integer('can_promo')->default(1);
            $table->integer('can_card')->default(1);
            $table->integer('can_invoice')->default(0);
            $table->integer('pay_uah')->default(1);
            $table->integer('pay_euro')->default(0);
            $table->integer('pay_usd')->default(0);
            $table->decimal('price_uah',10,2);
            $table->decimal('price_euro',10,2);
            $table->decimal('price_usd',10,2);
            $table->integer('template')->default(0);
            $table->timestamps();
        } );
    }

    public function down(): void {
        Schema::dropIfExists( 'events' );
    }
};
