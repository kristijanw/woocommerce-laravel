<?php

namespace App\Http\Controllers\WooCommerce;

use Illuminate\Http\Request;
use Automattic\WooCommerce\Client;
use App\Http\Controllers\Controller;

class WooCommerceController extends Controller
{
    protected $WOOCOMMERCE_STORE_URL;
    protected $WOOCOMMERCE_CONSUMER_KEY;
    protected $WOOCOMMERCE_CONSUMER_SECRET;

    public function __construct()
    {
        $this->WOOCOMMERCE_STORE_URL = env('WOOCOMMERCE_STORE_URL');
        $this->WOOCOMMERCE_CONSUMER_KEY = env('WOOCOMMERCE_CONSUMER_KEY');
        $this->WOOCOMMERCE_CONSUMER_SECRET = env('WOOCOMMERCE_CONSUMER_SECRET');
    }
    
    public function api()
    {
        $api = new Client(
            $this->WOOCOMMERCE_STORE_URL, // Your store URL
            $this->WOOCOMMERCE_CONSUMER_KEY, // Your consumer key
            $this->WOOCOMMERCE_CONSUMER_SECRET, // Your consumer secret
            [
                'version' => 'wc/v3' // WooCommerce WP REST API version
            ]
        );

        return $api;
    }

}
