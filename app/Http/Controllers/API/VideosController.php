<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Dingo\Api\Http\Response;
use Illuminate\Http\Request;
use Log;
use App\Models\VideoUrl;
use DB;
use Hash;
use Carbon\Carbon;
use Str;
use App\Helpers\helpers;
use App\Exceptions\CustomException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


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

}
