<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $fillable = ['user_id', 'instrumento_id', 'contenido'];

    public function user()
{
    return $this->belongsTo(User::class);
}

public function instrumento()
{
    return $this->belongsTo(Instrumento::class);
}
}
