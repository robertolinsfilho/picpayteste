<?php

namespace App\Classes;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiResponseClass
{
    public static function rollback($e, $message ="Ocorreu um erro inesperado! Processo nao completada"){
        DB::rollBack();
        self::throw($e, $message);
    }
    public static function errorUserNotFound($message ="Usuario nao encontrado"){
        DB::rollBack();
        throw new HttpResponseException(response()->json(["message"=> $message], 500));
    }
    public static function errorFounders($message ="Sem fundos suficientes"){
        DB::rollBack();
        throw new HttpResponseException(response()->json(["message"=> $message], 500));
    }
    public static function errorType($message ="Usuario lojista nao pode fazer transferencia"){
        DB::rollBack();
        throw new HttpResponseException(response()->json(["message"=> $message], 500));
    }

    public static function throw($e, $message ="Something went wrong! Process not completed"){
        Log::info($e);
        throw new HttpResponseException(response()->json(["message"=> $message], 500));
    }

    public static function sendResponse($result , $message ,$code=200){
        $response=[
            'success' => true,
            'data'    => $result
        ];
        if(!empty($message)){
            $response['message'] =$message;
        }
        return response()->json($response, $code);
    }
}
