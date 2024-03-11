<?php

namespace App\Http\Controllers;

use App\Models\Prodcts;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function showProducts()
    {
        $products = Prodcts::all();

        return view('user.products', ['products' => $products]);
    }


    public function showCreateProduct()
    {
        return view('user.productsCreate');
    }
    public function createProducts(Request $request)
    {

    }

}
