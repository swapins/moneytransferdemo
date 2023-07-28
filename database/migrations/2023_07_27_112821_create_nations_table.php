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
        Schema::create('nations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('flag');
            $table->boolean('enable_send')->default(false);
            $table->boolean('enable_receive')->default(false);
            $table->longText('flagpng');
            $table->string('officalname');
            $table->string('region');
            $table->string('subregion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nations');
    }
};
