<?php

namespace App\Http\Controllers\WooCommerce\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\WooCommerce\WooCommerceController;

class ProductController extends Controller
{
    protected $api;

    public function __construct(WooCommerceController $woocommerce)
    {
        $this->api = $woocommerce->api();
    }

    public function all()
    {
        return $this->api->get('products');
    }

    public function find($product_id)
    {
        return $this->api->get('products/'.$product_id.'');
    }

    public function put($product_id, $data)
    {
        return $this->api->put('products/'.$product_id.'', $data);
    }

    public function post($data)
    {
        return $this->api->post('products', $data);
    }

    public function batch($data)
    {
        return $this->api->post('products/batch', $data);
    }

    public function sku($params)
    {
        return $this->api->get('products', $params);
    }

    public function delete($product_id)
    {
        return $this->api->delete('products/'.$product_id.'', ['force' => true]);
    }
}
