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
        // 1. Roles
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('namaRole')->unique();
            $table->timestamps();
        });

        // 2. Menus
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('namaMenu');
            $table->string('url')->nullable();
            $table->string('icon')->nullable();
            $table->json('akses')->nullable(); // array role IDs or role names
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        // Update Users Table to include uuid and role_id
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'uuid')) {
                $table->uuid('uuid')->nullable()->unique()->after('id');
            }
            if (!Schema::hasColumn('users', 'role_id')) {
                $table->foreignId('role_id')->nullable()->constrained('roles')->nullOnDelete()->after('password');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'role_id')) {
                $table->dropForeign(['role_id']);
                $table->dropColumn('role_id');
            }
            if (Schema::hasColumn('users', 'uuid')) {
                $table->dropColumn('uuid');
            }
        });

        Schema::dropIfExists('menus');
        Schema::dropIfExists('roles');
    }
};
