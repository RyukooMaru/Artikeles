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
        Schema::create('artikeles', function (Blueprint $table) {
            $table->id('artikelesid');
            $table->unsignedBigInteger('userid');
            $table->foreign('userid')->references('userid')->on('user')->onDelete('cascade');
            $table->string('judul');
            $table->string('lseo');
            $table->string('kseo');
            $table->text('konten');
            $table->timestamp('deltime')->nullable();
            $table->string('delmode');   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artikeles');
    }
};
