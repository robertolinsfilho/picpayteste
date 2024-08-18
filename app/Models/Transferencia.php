<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transferencia extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'transferencias';

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'value',
        'payer',
        'payee',
    ];
}
