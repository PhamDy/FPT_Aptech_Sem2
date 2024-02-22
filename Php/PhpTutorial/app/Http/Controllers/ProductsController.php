<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {

        $myphone = [
            'name' => 'iphone 14',
            'year' => '2022',
            'isFavorited' => true
        ];
        print_r(route('products'));
        return view('products.index');
    }

    public function detail($productName, $id)
    {
        return "product's name = ".$productName.
                 " ,product's id = ".$id;
//        $phones = [
//            'iphone 15' => 'iphone 15',
//            'samsung' => 'samsung'
//        ];
//        return view('products.index', [
//           'product' => $phones[$productName] ?? 'unknown'
//        ]);

    }




    public function about()
    {
        return 'This is About page';
    }

}
