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
        // 7. Manajemen Portofolio
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('namaProject');
            $table->text('keterangan')->nullable();
            $table->json('gambar')->nullable(); // JSON array maksimal 3 file
            $table->timestamps();
        });

        // 8. Manajemen Pilar
        Schema::create('pillars', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('namaPilar');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        // 9. Manajemen Berita
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->longText('keterangan')->nullable();
            $table->json('gambar')->nullable(); // JSON array maksimal 3 file
            $table->timestamps();
        });

        // 10. Manajemen Visitor (Berdasarkan IP unik harian)
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('ip_address', 45);
            $table->text('user_agent')->nullable();
            $table->date('visit_date');
            $table->unsignedInteger('visit_count')->default(1);
            $table->timestamps();

            // Constraint unik: 1 IP hanya 1 baris per tanggal
            $table->unique(['ip_address', 'visit_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitors');
        Schema::dropIfExists('news');
        Schema::dropIfExists('pillars');
        Schema::dropIfExists('portfolios');
    }
};
