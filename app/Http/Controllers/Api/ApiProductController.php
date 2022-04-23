<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\WooCommerce\Product\ProductController;
use App\Http\Controllers\Admin\DataStructure\ProductStructureController;

class ApiProductController extends Controller
{
    protected $products;
    protected $structure;

    public function __construct(ProductController $products, ProductStructureController $structure)
    {
        $this->products = $products;
        $this->structure = $structure;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->products->all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->structure->product_store($request);
        $createProduct = $this->products->batch($data);

        if(empty($createProduct)){
            return ['status' => 'errors', 'message' => 'Product not created 🤔'];
        }

        return ['status' => 'success', 'message' => 'Product is created 😃'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->products->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->structure->product_update($request);
        $updateProduct = $this->products->put($id, $data);

        if(empty($updateProduct)){
            return ['status' => 'errors', 'message' => 'Product not update 🤔'];
        }

        return ['status' => 'success', 'message' => 'Product is update 😃'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $find_id = $this->products->sku([
            'sku' => $id
        ]);

        if(empty($find_id) && isset($find_id)){
            return ['status' => 'errors', 'message' => 'Not found products 🤔'];
        }

        $product_id = collect($find_id)->first()->id;
        $deleteProduct = $this->products->delete($product_id);

        if(empty($deleteProduct)){
            return ['status' => 'errors', 'message' => 'Product not deleted 🤔'];
        }

        return ['status' => 'success', 'message' => 'Product is deleted 😃'];
    }
}
