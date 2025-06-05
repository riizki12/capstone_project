<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonasiModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'whatsapp', 'nominal', 'payment_method', 'message', 'status', 'confirmed_by',
    ];

    // Definisikan relasi jika diperlukan
    public function user()
    {
        return $this->belongsTo(User::class, 'confirmed_by');
    }
}
