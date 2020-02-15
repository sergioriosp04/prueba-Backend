<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BilleteraController extends Controller
{
    public function recargar(Request $request){
        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);

        if(!empty($params_array)){
            //limpiar datos
            $params_array = array_map('trim', $params_array);
            $validator = \Validator::make($params_array, [
                'documento' => 'required|numeric|min:99999',
                'celular' => 'required|numeric|digits:10',
                'saldo' => 'required|numeric|min:10000|max:500000'
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
                'message' => 'no se enviaron datos o son incorrectos'
            ];
        }
        return response()->json($data, $data['code']);
    }

    public function pagar(Request $request){
        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);

        if(!empty($params_array)){
            //limpiar datos
            $params_array = array_map('trim', $params_array);
            $validator = \Validator::make($params_array, [
                'documento' => 'required|numeric|min:99999',
                'celular' => 'required|numeric|digits:10',
                'pagar' => 'required|numeric|min:10000|max:500000'
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
                'message' => 'No se enviaron datos o son incorrectos'
            ];
        }
        return response()->json($data, $data['code']);
    }

    public function confirmar(){
        return 'confirmar';
    }

    public function consultar(Request $request){
        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);

        if(!empty($params_array)){
            //limpiar datos
            $params_array = array_map('trim', $params_array);
            $validator = \Validator::make($params_array, [
                'documento' => 'required|numeric|min:99999',
                'celular' => 'required|numeric|digits:10'
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
                'message' => 'No se enviaron datos o son incorrectos'
            ];
        }
        return response()->json($data, $data['code']);
    }
}
