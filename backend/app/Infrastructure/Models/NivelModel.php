<?php

namespace App\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static find(int $getId)
 */
class NivelModel extends Model
{
    protected $table = 'niveis';
    protected $fillable = ['nivel'];
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function desenvolvedor()
    {
//        return $this->belongsTo(DesenvolvedorModel)
    }
}
