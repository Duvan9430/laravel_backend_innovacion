<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Temas  extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table='temas';

    public $timestamps = true;

    protected $dates = ['deleted_at'];

    protected $hidden = ['updated_at','deleted_at'];

    protected $fillable = ['temas'];


}
