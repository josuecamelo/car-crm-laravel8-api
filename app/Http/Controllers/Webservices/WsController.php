<?php

namespace App\Http\Controllers\Webservices;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WsController extends Controller
{
    public function cep(Request $request)
    {
        $cep = str_replace("-", "", $request->cep);
        $response = Http::get('viacep.com.br/ws/'.$cep.'/json');

        $response = $response->json();
        
        if($response) {
            $data = (object) [
                'uf' => $response['uf'],
                'zipCode' => $request['cep'],
                'city' => $response['localidade']
            ];

            return json_encode($data);
        }
    }
}
