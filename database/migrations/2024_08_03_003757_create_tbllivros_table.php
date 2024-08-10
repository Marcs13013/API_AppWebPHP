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
        Schema::create('tbllivros', function (Blueprint $table) {
            $table->id("codigo");
            $table->string('nomeLivro', 30);    // nomeLivro varchar(30)
            $table->string('generoLivro', 10);  // generoLivro varchar(10)
            $table->date("anoLivro");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbllivros');
    }
};
