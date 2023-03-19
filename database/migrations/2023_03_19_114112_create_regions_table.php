<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create( 'regions', function ( Blueprint $table ) {
            $table->id();
            $table->string('name_uk');
            $table->string('name_ru');
            $table->string('name_en');
            $table->timestamps();
        } );
    }

    public function down(): void {
        Schema::dropIfExists( 'regions' );
    }
};
