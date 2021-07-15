<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\BitcoinData;

class BitcoinDataController extends Controller
{
    public function getData(){

        $client = new Client();

        $params = [
            'query' => [
               'ids' => 'bitcoin',
               'vs_currencies' => 'usd',
               'include_market_cap' => 1
            ]
         ];

        $res = $client->request('GET', 'https://api.coingecko.com/api/v3/simple/price', $params);

        $body = json_decode($res->getBody()->getContents());

        $btc_usd = $body->bitcoin->usd;

        $bitcoin_data = new BitcoinData;
        $bitcoin_data->btc_usd = $btc_usd;
        $bitcoin_data->save();

        return response()->json(['value' => $btc_usd]);
    }
}
