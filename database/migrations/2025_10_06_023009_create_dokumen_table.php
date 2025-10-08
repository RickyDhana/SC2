<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('dokumen', function (Blueprint $table) {
        $table->id();
        $table->string('nomor_dokumen');
        $table->date('tanggal_dokumen');
        $table->string('perihal');
        $table->string('tujuan');
        $table->string('file_pdf')->nullable(); // ✅ Tambahkan ini
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen');
    }
};
