<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BilleteraController extends Controller
{
    public $url;

    public function __construct(){
        $this->url = 'http://prueba-api-db.test/';
    }


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
                $url = $this->url . 'recargar';
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
                $url = $this->url . 'pagar';
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
                'message' => 'No se enviaron datos o son incorrectos'
            ];
        }
        return response()->json($data, $data['code']);
    }

    public function confirmar(Request $request){
        $jwt = $request->header('Authorization');
        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);

        if(!empty($params_array)){
            $params_array = array_map('trim', $params_array);
            $validator = \Validator::make($params_array,[
                'token' => 'required|size:6'
            ]);
            if($validator->fails()){
                $data = [
                    'status' => 'error',
                    'code' => 400,
                    'message' => $validator->errors()
                ];
            }else{
                // datos validos, enviar a la capa 1
                $authorization = 'Authorization:'. $jwt;
                $url = $this->url . 'confirmar';
                $ch = curl_init($url);
                $payload = json_encode($params_array);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
                //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/x-www-form-urlencoded'));
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', $authorization));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $result = curl_exec($ch);
                return $result;
                $result_json = json_decode($result, true);
                $data = $result_json;
            }
        }else{
            $data = [
                'status' => 'error',
                'code' => 400,
                'message' => 'no se envio el token'
            ];
        }
        return response()->json($data, $data['code']);
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
                $url = $this->url . 'consultar';
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
                'message' => 'No se enviaron datos o son incorrectos'
            ];
        }
        return response()->json($data, $data['code']);
    }
}
