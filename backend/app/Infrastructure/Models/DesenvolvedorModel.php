<?php

namespace App\Infrastructure\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    protected $hidden = ['nivel_id'];
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $casts = ['data_nascimento' => 'datetime:Y-m-d'];

    public function nivel(): BelongsTo {
        return $this->belongsTo(NivelModel::class, 'nivel_id');
    }
}
