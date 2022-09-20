<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Log;
use Auth;
class MiddleWareRaza
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        
        $res = false;
        if($request->user()->type_user == 1){
            $res = true;
        }
        else{
            $permisos = json_decode($request->user()->permisos);
            foreach ($permisos as $perm){
                if($perm->id == 1){
                    $res = true;
                }
            }
        }
        
        if ($res) {
            return $next($request);
        } else {
            $message = ["message" => "Permission Denied"];
            return response($message, 401);
        }
    }
}
