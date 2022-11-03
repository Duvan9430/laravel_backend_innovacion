<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class AlmacenResUsu  extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table='almacen_rta_usu';

    public $timestamps = true;

    protected $dates = ['deleted_at'];

    protected $hidden = ['updated_at','deleted_at'];

    protected $fillable = ['user_id','preguntas_id','respuestas_id'];

    public function user() {
        return $this->hasOne(User::class,'id','user_id');
    }
    public function preguntas() {
        return $this->hasOne(Preguntas::class,'id','preguntas_id');
    }
    public function respuestas() {
        return $this->hasOne(Respuestas::class,'id','respuestas_id');
    }

}
