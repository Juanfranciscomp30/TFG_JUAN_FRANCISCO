<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instrumento extends Model
{
    use HasFactory;
    protected $table = 'instrumentos';

    // Los atributos que son asignables de manera masiva
    protected $fillable = [
        'tipo',
        'marca',
        'modelo',
        'precio',
        'foto',
        'stock',
    ];

    public function comentarios()
{
    return $this->hasMany(Comentario::class);
}
}
