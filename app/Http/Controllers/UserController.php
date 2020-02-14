<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function registro(Request $request){

        $json = $request->input('json', null);
        $params = json_encode($json);
        $params_array = json_encode($json, true);

        if(!empty($params_array)){
            //limpiar datos
            $params_array = array_map('trim', $params_array);

            $validator = \Validator::make($params_array, [
                'nombre' => 'required',
                'email' => 'required|email|unique:users'
            ]);
        }else{

        }


        return 'registro cliente';
    }
}
