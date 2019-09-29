<?php


namespace App\Http\Controllers\API;


use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\File;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\Array_;
use Validator;


class UserPRMController extends BaseController {


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $baseUrl = 'https://server3.datacrm.la/datacrm/sanofi/webservice.php';
        $client = new Client(
            [
                'defaults' => [
                    'headers' => [
                        'content-type' => 'application/x-www-form-urlencoded',
                        'Accept' => 'application/json',
                    ],
                ],
            ]
        );
        $sessionName = $this->getSessionName();

        $accounts = json_decode($client->request('GET',
            $baseUrl . '?operation=query&sessionName=' . $sessionName . '&query=select * from Accounts;')
            ->getBody())->result;
        $users = Array();
        foreach ($accounts as $account){
            $users[] = array(
                'accountname'=> $account->accountname,
                'account_no' => $account->account_no,
                'phone' => $account->phone,
                'email1'=> $account->email1,
                'rating'=> $account->rating,
                'siccode'=> $account->siccode,
                'emailoptout' => $account->emailoptout,
                'assigned_user_id' => $account->assigned_user_id,
                'createdtime'=> $account->createdtime,
                'modifiedtime'=> $account->modifiedtime,
                'modifiedby' => $account->modifiedby,
                'bill_street' => $account->bill_street,
                'isconvertedfromlead'=> $account->isconvertedfromlead,
                'createdby' => $account->createdby,
                'cf_935' => $account->cf_935,
                'cf_937'=>$account->cf_937,
                'cf_939'=> $account->cf_939,
                'cf_941'=> $account->cf_941,
                'cf_943'=> $account->cf_943,
                'cf_951'=> $account->cf_951,
                'cf_953'=> $account->cf_953,
                'cf_955'=> $account->cf_955,
                'cf_957'=> $account->cf_957,
                'cf_965'=> $account->cf_965,
                'cf_967'=> $account->cf_967,
                'cf_971'=> $account->cf_971,
                'cf_983'=> $account->cf_983,
                'cf_997'=> $account->cf_997,
                'cf_1005'=> $account->cf_1005,
                'cf_1007'=> $account->cf_1007,
                'cf_1011'=> $account->cf_1011,
                'cf_1253'=> $account->cf_1253,
                'cf_1763'=> $account->cf_1763,
                'cf_2007'=> $account->cf_2007,
                'id'=> $account->id
            );
        }
        return $this->sendResponse($users, 'Files retrieved successfully.');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'patient' => 'required',
            'id_form' => 'required',
            'type' => 'required',
        ]);

        //get the base-64 from data
        $base64_str = substr($input['url'], strpos($input['url'], ",") + 1);

        //decode base64 string
        $image = base64_decode($base64_str);

        $safeName = str_random(10) . '.' . 'png';
        Storage::disk('public')
            ->put('sanofi/' . $input['type'] . '/' . $safeName, $image);

        $path = '/storage/sanofi/' . $input['type'] . '/' . $safeName;


        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input['url'] = $path;
        $product = File::create($input);
        return $this->sendResponse($product->toArray(), 'File created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $product = File::find($id);


        if (is_null($product)) {
            return $this->sendError('Product not found.');
        }


        return $this->sendResponse($product->toArray(), 'Product retrieved successfully.');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product) {
        $input = $request->all();


        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required',
        ]);


        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }


        $product->name = $input['name'];
        $product->detail = $input['detail'];
        $product->save();


        return $this->sendResponse($product->toArray(), 'Product updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $product) {
        $product->delete();


        return $this->sendResponse($product->toArray(), 'File deleted successfully.');
    }
}
