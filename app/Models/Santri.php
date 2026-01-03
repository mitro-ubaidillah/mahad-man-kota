<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;

class Santri extends Model
{
    use HasFactory;

    protected $fillable = [
        'nis', 'name', 'email', 'phone', 'kelas_id', 'birth_date',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
}
