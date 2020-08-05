<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GraphQL\Client;
use Exception;
use App;

class shopifyController extends Controller
{
    protected $client;

    public function __construct()
    {
    	$this->client = new Client(
            env('API_SHOP_DOMAIN').'/admin/api/2020-07/graphql.json',
            [],
            [ 
                'headers' => [
                    'Content-Type' => 'application/json',
                    'X-Shopify-Access-Token' => env('API_KEY')
                ],
            ]
        );
        
    }
    
}
