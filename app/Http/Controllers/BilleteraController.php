<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BilleteraController extends Controller
{
    public function recargar(){
        return 'recargar';
    }

    public function pagar(){
        return 'pagar';
    }

    public function confirmar(){
        return 'confirmar';
    }

    public function consultar(){
        return 'consultar';
    }
}
