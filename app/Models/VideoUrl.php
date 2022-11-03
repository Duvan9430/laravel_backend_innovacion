<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class VideoUrl extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table='url_videos';

    public $timestamps = true;

    protected $dates = ['deleted_at'];

    protected $hidden = ['updated_at','deleted_at'];

    protected $fillable = ['url_videos','temas_id'];

    public function temas() {
        return $this->hasOne(Temas::class,'id','temas_id');
    }

}
