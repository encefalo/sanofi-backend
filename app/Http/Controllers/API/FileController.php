<?php


namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\File;
use Illuminate\Support\Facades\Storage;
use Validator;


class FileController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $products = File::all();


        return $this->sendResponse($products->toArray(), 'Files retrieved successfully.');
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
        $base64_str = substr($input['url'], strpos($input['url'], ",")+1);

        //decode base64 string
        $image = base64_decode($base64_str);

        $safeName = str_random(10).'.'.'png';
        Storage::disk('public')->put('sanofi/' . $input['type'] . '/' . $safeName, $image);

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
