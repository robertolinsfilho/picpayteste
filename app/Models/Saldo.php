<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saldo extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'saldos';

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'saldo',
        'id_usuario',
    ];
}
