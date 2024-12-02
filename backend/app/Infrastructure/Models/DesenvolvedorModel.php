<?php

namespace App\Infrastructure\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static find(int $getId)
 */
class DesenvolvedorModel extends Model
{
    protected $table = 'desenvolvedores';
    protected $fillable = [
        'nivel_id',
        'nome',
        'sexo',
        'data_nascimento',
        'hobby'
    ];
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $casts = ['data_nascimento' => 'datetime:Y-m-d'];
}
