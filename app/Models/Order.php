<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    protected $fillable = ['order_status','payment_status'];

    protected $casts = [

    ];
}
