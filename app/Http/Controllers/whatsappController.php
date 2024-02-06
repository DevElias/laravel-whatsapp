<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as data;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;

class whatsappController extends Controller
{
    const TOKEN = 'vcsk6qcg2vvf7dnn';
    const INSTANCE = 'instance76631';
    const API_URL = 'https://api.ultramsg.com/instance76631/messages/chat';
    const TELEPHONE = '';
    CONST MESSAGE = 'Hola Voluntario, Te invitamos para la proxima construcción de 100 viviendas en TECHO!! Para inscribirse haz click en este link https://techo.org/';

    public function sendMessage (data $request) {

        $telephone = $request->input('number');
        $message = $request->input('message');

        $params=array(
            'token' => whatsappController::TOKEN,
            'to' => $telephone,
            'body' => $message,
            'priority' => '10',
            'referenceId' => '',
            'msgId' => '',
            'mentions' => ''
            );
            
            $client = new Client();
            $headers = [
              'Content-Type' => 'application/x-www-form-urlencoded'
            ];
            $options = ['form_params' =>$params ];
            $request = new Request('POST', whatsappController::API_URL, $headers);
            $res = $client->sendAsync($request, $options)->wait();
            echo $res->getBody();
    }
}
