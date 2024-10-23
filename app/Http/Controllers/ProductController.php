<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        
        $products = Product::with('features')->get();

        return view('products', compact('products'));
    }
}
