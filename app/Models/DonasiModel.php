<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonasiModel extends Model
{
    use HasFactory;

    // Sesuaikan dengan nama tabel Anda
    //protected $table = 'donasi_models';

    // Kolom yang dapat diisi secara massal (mass assignable)
    protected $fillable = [
        'user_id', //mengizinkan user_id diisi melalui form/controller
        'nama',
        'email',
        'nomor_telepon',
        'nominal',
        'metode_pembayaran',
        'status_pembayaran',
        'pesan',
        // 'program_donasi', // Tambahkan jika ada
    ];

    // Opsional: Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}