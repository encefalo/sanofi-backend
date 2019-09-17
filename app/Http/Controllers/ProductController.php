<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ProductController extends Controller {

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function index(){
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
        $products = json_decode($client->request('GET',
            $baseUrl . '?operation=query&sessionName=' . $sessionName . '&query=select * from Products;')->getBody())->result;
        return view('layouts.products.index', compact(['products']));
    }

    public function edit($id){
        return view('layouts.products.edit');
    }

}
