<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consulta extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'consultas';

    protected $fillable = [
        'medico_id',
        'paciente_id',
        'data',
    ];

    protected $dates = ['deleted_at', 'data'];

    public function medico()
    {
        return $this->belongsTo(Medico::class);
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
