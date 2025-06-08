<?php
// database/migrations/YYYY_MM_DD_create_donasi_models_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donasi_models', function (Blueprint $table) {
            $table->id();
            // User ID jika donasi terkait dengan user yang login (opsional)
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // Jika ingin bisa melacak donasi dari user terdaftar
            $table->string('nama')->nullable(); // Jika donasi dari tamu/anonim
            $table->string('email')->nullable(); // Jika donasi dari tamu/anonim
            $table->string('nomor_telepon')->nullable(); // Untuk kontak donatur
            $table->decimal('nominal', 10, 2); // Jumlah donasi, misalnya 10000.00
            $table->string('metode_pembayaran'); // BCA, OVO, GOPAY, DANA
            $table->string('status_pembayaran')->default('pending'); // pending, confirmed, failed
            $table->text('pesan')->nullable(); // Pesan dari donatur

            // Tambahkan field untuk program donasi jika diperlukan
            // $table->string('program_donasi')->nullable(); // Misalnya 'Duafa', 'Rumah', 'Beasiswa'

            $table->timestamps(); // created_at, updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donasi_models');
    }
};