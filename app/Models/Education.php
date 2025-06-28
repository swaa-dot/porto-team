<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $table = 'educations';


    protected $fillable = [
        'institusi',
        'jurusan',
        'deskripsi',
        'tahun_mulai',
        'tahun_selesai',
    ];
}
