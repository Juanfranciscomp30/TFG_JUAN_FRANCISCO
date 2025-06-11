<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Los atributos que son asignables de manera masiva.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'administrador'
    ];

    /**
     * Los atributos que deben ser ocultados para los arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Los atributos que deberían ser convertidos a tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }
}
