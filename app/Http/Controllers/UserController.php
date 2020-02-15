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
                //attach encoded JSON string to the POST fields
                curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

//set the content type to application/json
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/x-www-form-urlencoded'));

//return response instead of outputting
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//execute the POST request
                $result = curl_exec($ch);
                dd($result);

//close cURL resource
                curl_close($ch);
                return ' enviando datos a la capa 1';
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
