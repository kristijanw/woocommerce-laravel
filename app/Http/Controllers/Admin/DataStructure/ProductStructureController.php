<?php

namespace App\Http\Controllers\Admin\DataStructure;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\WooCommerce\Product\ProductController;

class ProductStructureController extends Controller
{
    protected $products;

    public function __construct(ProductController $products)
    {
        $this->products = $products;
    }

    public function product_store($request)
    {
        $request = $request->all();
        $data['create'] = $data['update'] = [];

        foreach ($request as $item) {
            $find_id = $this->products->sku([
                'sku' => $item['product_id']
            ]);

            $product_id = !empty( collect($find_id)->first() ) ? collect($find_id)->first()->id : null;

            if($product_id == null){
                $data['create'][] = [
                    'name' => $item['name'],
                    'regular_price' => $item['price'],
                    'description' => $item['description'],
                    'meta_data' => [
                        [
                            'key' => '_sku',
                            'value' => $item['product_id']
                        ]
                    ]
                ];
            } else {
                $data['update'][] = [
                    'id' => $product_id,
                    'name' => $item['name'],
                    'regular_price' => $item['price'],
                    'description' => $item['description'],
                ];
            }
        }

        return $data;
    }

    public function product_update($request)
    {
        $data = [
            'name' => $request->name,
            'regular_price' => '24.54'
        ];

        return $data;
    }
}
