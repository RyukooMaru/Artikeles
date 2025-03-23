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
        Schema::create('historysearch', function (Blueprint $table) {
            $table->id('historyid');
            $table->unsignedBigInteger('userid');
            $table->foreign('userid')->references('userid')->on('user')->onDelete('cascade');
            $table->text('history');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historysearch');
    }
};
