<?php

namespace App\Http\Controllers;

use App\Product;
use App\Rating;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $productss = array();
        $i =0;
        
        $products = Product::take(4)->orderBy('created_at','desc')->get();
        $rate = Rating::get()->where('stars_rated' , '>' , '3');

        foreach($rate as $itemRate){
           $productss[$i] = Product::orderBy('created_at','desc')->get()->where('id' , $itemRate->product_id);
            $i++;
            
        }


        
        
       
        
        
        
        return view('home.index',compact('products' , 'productss'));
        
    }
}