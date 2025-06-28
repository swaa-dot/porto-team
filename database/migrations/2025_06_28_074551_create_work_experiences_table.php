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
    Schema::create('work_experiences', function (Blueprint $table) {
        $table->id();
        $table->string('posisi');
        $table->string('perusahaan');
        $table->text('deskripsi')->nullable();
        $table->date('tanggal_mulai');
        $table->date('tanggal_selesai')->nullable(); // Bisa null jika masih bekerja
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_experiences');
    }
};
