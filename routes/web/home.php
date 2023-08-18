<?php

use App\Helpers\Cart\Cart;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DiscountPlansController;
use App\Http\Controllers\ProductController;
use App\Models\DiscountPlan;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;



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

Route::get('/', function () {


    return view('welcome');
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('products',[ProductController::class,'index']);
Route::get('products/{product}',[ProductController::class,'single']);

Route::post('cart/add/{product}',[CartController::class,'addToCart'])->name('cart.add');

Route::get('cart',[CartController::class,'cart']);

Route::patch('cart/quantity/change' ,[CartController::class,'quantityChange']);

Route::delete('cart/delete/{cart}' , [CartController::class,'deleteFromCart'])->name('cart.destroy');


Route::post('/discountplans/discountplans/check',function(Request $request){

  
   
    $discountplan = DiscountPlan::whereId($request['discountplan'])->first();
    $product = Product::whereId($request['productId'])->first();
    // dump($discountplan->id,$product->id);
   
  
    $cart = Cart::instance('cart');
    // dump($cart);
    foreach($cart->all() as $item){
        // dump($item['product']->discountplans->pluck('payment_type')->toArray());

     
        if($item['product']->id == $product->id){
            $item['discount_percent'] = $discountplan->percent /100;
            if($discountplan->payment_type == 'cash')
            {
                $item['product']->price = $item['product']->price -($item['product']->price * $item['discount_percent']); 
        
            }else
            {
                $item['product']->price = $item['product']->price +($item['product']->price * $item['discount_percent']);
        
            }
            $cart->update($item['id'],$item);

        }
        
    }
    
    

 
   
    return back();
  

});