<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;

    protected $table = 'dokumen';

    protected $fillable = [
        'nomor_dokumen',
        'tanggal_dokumen',
        'pekerjaan',
        'tujuan',
        'file_path',
    ];
}
