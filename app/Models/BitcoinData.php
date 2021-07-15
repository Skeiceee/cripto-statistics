<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BitcoinData extends Model
{
    protected $table = "bitcoin_data";
    protected $primaryKey = "id";

    protected $fillable = [
        'btc_usd',
    ];

}
