<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Preguntas extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table='preguntas';

    public $timestamps = true;

    protected $dates = ['deleted_at'];

    protected $hidden = ['updated_at','deleted_at'];

    protected $fillable = ['preguntas','puntuacion','temas_id'];

    public function temas() {
        return $this->hasOne(Temas::class,'id','temas_id');
    }

}
