<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

     /**
     * @var string
     */
    protected $table = 'usuarios';

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'nome',
        'cpf',
        'email',
        'senha',
        'tipo'
    ];

    /**
     * @var array
     */
    protected $hidden = [];

}
