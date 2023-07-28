<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exchanges', function (Blueprint $table) {
            $table->id();
            $table->string('sendCountry_id');
            $table->string('receiveCountry_id');
            $table->string('sendCountryCurrancy')->nullable();
            $table->string('receiveCountryCurrancy')->nullValue();
            $table->float('staticrate');
            $table->float('customrate');
            $table->integer('factor');
            $table->float('finalrate');
            $table->boolean('flag')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exchanges');
    }
};
