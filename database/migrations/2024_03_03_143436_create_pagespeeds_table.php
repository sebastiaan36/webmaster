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
        Schema::create('pagespeeds', function (Blueprint $table) {
            $table->id();
            $table->integer('mobile_score');
            $table->decimal('mobile_speed', 10,2);
            $table->integer('desktop_score');
            $table->decimal('desktop_speed',10,2);
            $table->foreignId('user_id')->constrained();
            $table->string('domain');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagespeeds');
    }
};
