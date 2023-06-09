<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create( 'phones', function ( Blueprint $table ) {
            $table->id();
            $table->bigInteger('card_id');
            $table->string('number')->index();
            $table->timestamps();
        } );
    }

    public function down(): void {
        Schema::dropIfExists( 'phones' );
    }
};
