<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Dingo\Api\Http\Response;
use Illuminate\Http\Request;
use Log;
use App\Models\VideoUrl;
use App\Models\Preguntas;
use App\Models\Respuestas;
use DB;
use Hash;
use Carbon\Carbon;
use Str;
use App\Helpers\helpers;
use App\Exceptions\CustomException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

class VideosController extends Controller
{

    public function __construct(helpers $helper)
    {
        $this->helper = $helper;
    }

    public function obtenerVideo($idVideo){
            $videos = VideoUrl::withoutTrashed()
                    ->join('temas as tem','tem.id','url_videos.temas_id')
                    ->where('temas_id',$idVideo)->get();
            return response()->json($videos);
    }
    public function obtenerVideoPreguntas($idVideo){

         $preguntas = Preguntas::withoutTrashed()
                ->join('respuestas as res','res.preguntas_id','preguntas.id')
                ->where('temas_id',$idVideo)
                ->select('preguntas.preguntas','preguntas.temas_id','res.preguntas_id')
                ->groupBy('preguntas.temas_id','preguntas.preguntas','res.preguntas_id')->get();
        return response()->json($preguntas);
    }
    public function obtenerVideoPreguntasRespuestas($idsPreguntas){
        $respuestas = Respuestas::withoutTrashed()
                ->whereIn('preguntas_id',explode(",",$idsPreguntas))->get();
        return response()->json($respuestas);
    }

}
