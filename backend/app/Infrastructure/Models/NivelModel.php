<?php

namespace App\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $array)
 * @method static find(int $getId)
 */
class NivelModel extends Model
{
    protected $table = 'niveis';
    protected $fillable = ['nivel'];
    protected $primaryKey = 'id';
    protected $foreignKey = 'nivel_id';
    public $timestamps = false;

    public function desenvolvedor(): HasMany
    {
        return $this->hasMany(DesenvolvedorModel::class , 'nivel_id');
    }
}
