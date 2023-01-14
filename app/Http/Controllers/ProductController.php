<?php

namespace App\Http\Controllers;

use App\Model\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where("price",">",0)->paginate(5);
        return view('product',compact("products"));
    }

    /**
     * Show the form for Buy product.
     *
     * @return \Illuminate\Http\Response
     */
    public function detail(product $product)
    {
        $intent = auth()->user()->createSetupIntent();
        return view('productDetail',compact("product", 'intent'));
    }
    /**
     * Make charge based upon card detail enterd by user.
     *
     * @return redirect back with message
     */
    public function purchase(Request $request, Product $product){
        $user          = $request->user();
        $paymentMethod = $request->input('payment_method');

        try {
            $user->createOrGetStripeCustomer();
            $user->updateDefaultPaymentMethod($paymentMethod);
            $user->charge($product->price * 100, $paymentMethod);        
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }

        return back()->with('message', 'Product purchased successfully!');
    }
}
