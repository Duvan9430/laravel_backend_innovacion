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
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{

    public function __construct(helpers $helper)
    {
        $this->helper = $helper;
    }

    public function login(Request $request)
    {
        $credentials = [
            'email' => $request['email'],
            'password' => $request['password'],
            'deleted_at' => null
        ];
        if (!auth()->attempt($credentials)) {
            abort(response()->json('Error usuario o contraseña', 401));
        }
        $user = User::where('email',$request['email'])->first();
        $token = $user->createToken('bXGLCSW9TfremwQHVplI4SHgmb0jwLueHFKIlRFV');

        return response([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
            'token' => $token->accessToken,
            'token_expires_at' => $token->token->expires_at,
        ], 200);
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


    public function logout(Request $request){
        dd("aa");
        try {
            DB::table('oauth_access_tokens')
            ->where('user_id', $request->user()->id)
            ->update([
                'revoked' => true
            ]);
            $response['success'] = true;
            return $response;
        } catch (Exception $e) {
            Debugbar::addThrowable($e);
            return response()->exception($e->getMessage(), $e->getCode());
        }
    }


}
