<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Respuestas extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table='respuestas';

    public $timestamps = true;

    protected $dates = ['deleted_at'];

    protected $hidden = ['updated_at','deleted_at'];

    protected $fillable = ['respuestas','preguntas_id','valor'];

    public function preguntas() {
        return $this->hasOne(Preguntas::class,'id','preguntas_id');
    }

}
