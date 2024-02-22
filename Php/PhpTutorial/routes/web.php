<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\PageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('products', [
    ProductsController::class,
    'index'
])->name('products');

Route::get('/', [
    PageController::class,
    'index'
]);

//
//Route::get('products/{id}', [
//    ProductsController::class,
//    'detail'
//])->where('id', '[0-9]+');

Route::get('products/{productName}/{id}', [
    ProductsController::class,
    'detail'
])->where([
    'productName' => '[a-zA-Z0-9]+',
    'id' => '[0-9]+'
]);

Route::get('about', [
   ProductsController::class,
   'about'
]);

//Route::get('/', function () {
//    return view('home');
//});
//
//Route::get('/users', function () {
//    return 'This is the users page';
//});
//
//Route::get('/foods', function () {
//    return ['sushi', 'sashimi', 'tofu'];
//});
//
//Route::get('/aboutMe', function () {
//    return response()-> json([
//        'name' => 'Pham Dac Dy',
//        'email' => 'phamdacdy@gmail.com'
//    ]);
//});
//
//Route::get('/something', function () {
//    return redirect()->to('/foods');
//});
//

