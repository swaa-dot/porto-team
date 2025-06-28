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
    Schema::create('educations', function (Blueprint $table) {
        $table->id();
        $table->string('institusi');
        $table->string('jurusan');
        $table->text('deskripsi')->nullable();
        $table->date('tahun_mulai');
        $table->date('tahun_selesai')->nullable(); // Bisa null jika sedang kuliah
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educations');
    }
};
