<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cidade extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'cidades';

    protected $fillable = [
        'nome',
        'estado',
    ];

    protected $dates = ['deleted_at'];
}
