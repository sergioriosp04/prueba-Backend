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
                'nombre' => 'required',
                'email' => 'required',
                'celular' => 'required|numeric',
                'documento' => 'required|numeric'
            ]);

            if($validator->fails()){
                $data = [
                    'success' => 'error',
                    'code' => 400,
                    'message' => $validator->errors()
                ];
            }else{
                // datos validos, enviar a la capa 1
                return ' enviando datos a la capa 1';
            }
        }else{
            $data = [
                'success' => 'error',
                'code' => 400,
                'message' => 'los datos enviados son erroneos'
            ];
        }

        return response()->json($data, $data['code']);
    }
}
