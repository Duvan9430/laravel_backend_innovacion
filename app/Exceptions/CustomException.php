<?php
namespace App\Exceptions;
use Exception;
use Illuminate\Support\Facades\Log;
class CustomException extends Exception {

    public static function CrearLogError($exception, $descripcion_adicional = ''){
        Log::error("$descripcion_adicional  listener handle.".$exception->getFile().' en la linea '.$exception->getLine(), [$exception]);
        return ['status' => 'error', 'message' => $descripcion_adicional];
    }
}
