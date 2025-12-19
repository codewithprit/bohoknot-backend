<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productHomePage(){
        return view('products.products');
    }


    public function productDetailsPage($id){
        return view('products.product_details', ['id' => $id]);
    }


    
}
