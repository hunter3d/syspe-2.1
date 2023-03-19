<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create( 'topics', function ( Blueprint $table ) {
            $table->id();
            $table->bigInteger('exhibition_id')->default(0);
            $table->string('name_uk');
            $table->string('name_ru');
            $table->string('name_en');
            $table->enum('template',[0,1])->default(0);
            $table->timestamps();
        } );
    }

    public function down(): void {
        Schema::dropIfExists( 'topics' );
    }
};
