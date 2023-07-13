<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('products.index', [
            'products' => $this->getProducts(),
            'status' => session('status'),
            'notification' => session('notification'),
        ]);
    }

    public function getProducts()
    {
        return Product::all();
    }
}
