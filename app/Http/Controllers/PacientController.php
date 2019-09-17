<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PacientController extends Controller
{
    public function preregister() {
        $currentTime = Carbon::now()->format('Y-m-d');
        $baseUrl = 'https://server3.datacrm.la/datacrm/sanofi/webservice.php';
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
        $sessionName = $this->getSessionName();
        $accounts = json_decode($client->request('GET',
            $baseUrl . '?operation=describe&sessionName=' . $sessionName . '&elementType=Accounts')->getBody())->result->fields;
        return view('layouts.patients.preregister', compact(['accounts']));
    }
}
