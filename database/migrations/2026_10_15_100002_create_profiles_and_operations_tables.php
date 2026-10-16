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
        // 3. Manajemen Profil Perusahaan
        Schema::create('company_profiles', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('namaPerusahaan');
            $table->text('alamatPerusahan')->nullable();
            $table->string('nomorTeleponPerusahaan')->nullable();
            $table->string('emailPerusahaan')->nullable();
            $table->string('websitePerusahaan')->nullable();
            $table->string('instagram')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('treads')->nullable();
            $table->string('facebook')->nullable();
            $table->timestamps();
        });

        // 4. Manajemen Visi Misi
        Schema::create('vision_missions', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->text('visi');
            $table->text('misi');
            $table->timestamps();
        });

        // 5. Manajemen Penawaran
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('namaPIC');
            $table->string('namaPerusahaan');
            $table->string('nomorTelepon');
            $table->string('email')->nullable();
            $table->string('jenisKebutuhan')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('status')->default('baru'); // baru, diproses, selesai
            $table->timestamps();
        });

        // 6. Manajemen Wilayah Operasional
        Schema::create('operational_areas', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('namaWilayah');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operational_areas');
        Schema::dropIfExists('quotations');
        Schema::dropIfExists('vision_missions');
        Schema::dropIfExists('company_profiles');
    }
};
