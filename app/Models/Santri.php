<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    use HasFactory;

    protected $fillable = [
        'nis', 'name', 'email', 'phone', 'kelas', 'birth_date',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];
}
