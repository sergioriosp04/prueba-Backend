<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    //
    public function registro(Request $request){

        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);

        if(!empty($params_array)){
            //limpiar datos
            $params_array = array_map('trim', $params_array);

            $validator = \Validator::make($params_array, [
                'nombre' => 'required|alpha',
                'email'=> 'required|email|',
                'celular' => 'required|numeric|digits:10|',
                'documento' => 'required|numeric|'
            ]);

            if($validator->fails()){
                $data = [
                    'success' => 'error',
                    'code' => 400,
                    'message' => $validator->errors()
                ];
            }else{
                // datos validos, enviar a la capa 1
                $url = 'http://prueba-api-db.test/registro';
                $ch = curl_init($url);
                $payload = json_encode($params_array);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
                //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/x-www-form-urlencoded'));
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $result = curl_exec($ch);
                $result_json = json_decode($result, true);
                $data = $result_json;
            }
        }else{
            $data = [
                'success' => 'error',
                'code' => 400,
                'message' => 'no se enviaron datos o son incorrectos'
            ];
        }

        return response()->json($data, $data['code']);
    }
}
