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
        Schema::create('eviden', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('perbaikan_id')->unsigned();
            $table->foreign('perbaikan_id')->references('id')->on('perbaikan');
            $table->string('filename');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eviden');
    }
};
