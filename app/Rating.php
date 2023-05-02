<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    //
    protected $table = "recommends";
    protected $fillable=[
        "user_id",
        "product_id",
        "stars_rated"
    ];

}
