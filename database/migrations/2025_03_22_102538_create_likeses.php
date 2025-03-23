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
        Schema::create('likeses', function (Blueprint $table) {
            $table->id('likesesid');
            $table->unsignedBigInteger('userid');
            $table->foreign('userid')->references('userid')->on('user')->onDelete('cascade');
            $table->unsignedBigInteger('artikelesid');
            $table->foreign('artikelesid')->references('artikelesid')->on('artikeles')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likeses');
    }
};
