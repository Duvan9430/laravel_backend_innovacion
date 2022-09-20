<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Log;
use App\Models\User;
use DB;
use Hash;
use Carbon\Carbon;
use Str;
use App\Helpers\helpers;
use App\Exceptions\CustomException;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{

    public function __construct(helpers $helper)
    {
        $this->helper = $helper;
    }

    public function login(Request $request)
    {
        $credentials = [
            'email' => $request['username'],
            'password' => $request['password'],
            'deleted_at' => null
        ];
        if (!auth()->attempt($credentials)) {
            abort(response()->json('Error usuario o contraseña', 401));
        }
        $user = User::where('email',$request['username'])->first();
        $token = $user->createToken('bXGLCSW9TfremwQHVplI4SHgmb0jwLueHFKIlRFV')->accessToken;


        return response(['token' => $token]);
    }

    

    public function register(Request $request)
    {
        try{
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
        ], $this->helper->message_validator());


        if($validator->fails()){

            $response['success'] = false;
            $response['error'] = $validator->messages();

        }
        else{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $response['success'] = true;
            $response['message'] = "Información guardada correctamente";
        }
        return $response;

        }catch(CustomException $ex){
            $retorno = CustomException::CrearLogError($ex, 'Error al generar los cambios UserController::setUsuario');

        }
    }

    public function logout (Request $request){
        DB::table('oauth_access_tokens')
        ->where('user_id', $request->user()->id)
        ->update([
            'revoked' => true
        ]);
        $response['success'] = true;
        return $response;
    }


}
