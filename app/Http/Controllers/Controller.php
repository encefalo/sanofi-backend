<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController {
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getSessionName(){
        $baseUrl = 'https://server3.datacrm.la/datacrm/sanofi/webservice.php';
        $username = 'frenteweb';
        $accessKey = '12345';
        //GET TOKEN
        $client = new Client(
            [
                'defaults' => [
                    'headers'  => [
                        'content-type' => 'application/x-www-form-urlencoded',
                        'Accept' => 'application/json'
                    ],
                ],
            ]
        );
        $request = $client->request('GET',$baseUrl . '?operation=getchallenge&username=frenteweb');
        $response = $request->getBody();
        $token = json_decode($response)->result->token;
        // LOGIN
        $client = new Client([
            'defaults' => [
                'headers'  => [
                    'content-type' => 'application/x-www-form-urlencoded'
                ],
            ],
        ]);
        $accessMD5 = md5($token);

        $request = $client->request('POST', $baseUrl,  [
            'form_params' => [
                'username'=> $username,
                'operation' => 'login',
                'accessKey' => $accessKey,
                'token' => $accessMD5
            ]
        ]);
        $sessionName = json_decode($request->getBody())->result->sessionName;
        return $sessionName;
    }
}
