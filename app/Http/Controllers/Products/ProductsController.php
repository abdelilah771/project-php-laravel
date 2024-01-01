<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\Product\category;
use App\Models\Product\Cart;
use App\Models\Product\Order;
use Redirect;
use Auth;
use Session;

class ProductsController extends Controller
{
    

    public function singleCategory($id) {

        $products = Product::select()->orderBy('id', 'desc')
         ->where('category_id',$id)->get();
        return view('products.singlecategory', compact('products'));
    }

    public function singleProduct($id) {

        $product = Product::find($id);
        $relatedProducts = Product::where('Category_id' , $product->category_id)
         ->where('id','!=',$id)
         ->get();
        
        $checkInCart = cart::where("pro_id",$id)

         ->where('user_id' ,Auth::user()->id)
         ->count();

        return view('products.singleProduct', compact('product' , 'relatedProducts','checkInCart'));
    }

    public function shop() {

        $categories = category::select()->orderBy('id','desc')->get();

        $mostWanted = product::select()->orderBy('Name','desc')->take(5)
         ->get();
         
        $composants = product::select()->where('category_id','=' , 5)
         ->orderBy('id','desc')->take(5)
         ->get();
        $clavier = product::select()->where('category_id','=' , 4)
         ->orderBy('id','desc')->take(5)
         ->get();
        $case = product::select()->where('category_id','=' , 1)
         ->orderBy('id','desc')->take(5)
         ->get();
        $pack = product::select()->where('category_id','=' , 2)
         ->orderBy('id','desc')->take(5)
         ->get();
        return view('products.shop', compact('categories','mostWanted','composants', 'clavier' , 'case' , 'pack'));
    }

    public function addToCart (Request $request) {
       
       $addCart = Cart::create([

            "name"=>$request->name,
            "price"=>$request->price,
            "qty"=>$request->qty,
            "image"=>$request->image,
            "pro_id"=>$request->pro_id,
            "user_id"=>Auth::user()->id,
            "subtotal"=> $request->qty * $request->price
       ]);

       if($addCart){

        return Redirect::route("single.Product",$request->pro_id)->with(['success' => 'item add to cart thank you!']);

       }
       

       

    }

    public function Cart() {
        $cartProducts = Cart::select()->where('user_id', Auth::user()->id)
        ->get();
        $subtotal = Cart::select()->where('user_id', Auth::user()->id)->sum('subtotal');

     return view('products.cart',compact('cartProducts', 'subtotal'));
    }

    public function deleteFromcart($id) {
        
        $deleteCart = Cart::find($id);

        $deleteCart ->delete();

        

            if($deleteCart){
                return Redirect::route("products.cart")->with(['delete' => 'item is delete from cart sir 😥!']);

            }
    }


    public function prepareCheckout(Request $request ){
        $price = $request->price;
        
        $value = Session::put('value',$price);
        
        $newPrice = Session::get($value);
        
        if($newPrice >0) {
            return Redirect::route("products.checkout");  

        }

    }

    public function checkout(){

        $cartItems = cart::select()->where('user_id',Auth::user()->id)->get();
        $checkoutSubtotal = cart::select()->where('user_id',Auth::user()->id)
        ->sum('subtotal');


       return view('products.checkout',compact('cartItems','checkoutSubtotal'));
    }

    public function proccessCheckout(Request $request){
        // Get the data from session

        $checkout = Order::create([

            "name"=>$request->name,
            "last_name"=>$request->last_name,
            "address"=>$request->address,
            "regions"=>$request->regions,
            "city"=>$request->city,
            "code_postal"=>$request->code_postal,
            "email"=>$request->email,
            "phone"=>$request->phone,
            "price"=>$request->price,
            "user_id"=>$request->user_id,
            "order_notes"=>$request->order_notes,
       ]);

       $value = Session::put('value',$request->price);
        
       $newPrice = Session::get($value);

       if($checkout){

        return Redirect::route("products.pay");

       }

    }
    
    public function payWithPaypal(){

        return view('products.pay');
        
    }
    public function success(){
        
        $deleteItemFromCart = Cart::where('user_id',Auth::user()->id);
        $deleteItemFromCart->delete();

        if($deleteItemFromCart){

            Session::forget('value');
            
            return view("products.success");
    
        }
    
    }

}