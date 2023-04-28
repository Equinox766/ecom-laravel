<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\ShippingInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function CategoryPage($id) {
        $category = Category::findOrFail($id);
        $products = Product::where('product_category_id', $id)->latest()->get();
        return view('user.category', compact( 'category', 'products'));
    }
    public function SingleProduct($id) {
        $product = Product::findOrFail($id);
        $subcat_id = Product::where('id', $id)->value('product_subcategory_id');
        $related_products = Product::where('product_subcategory_id', $subcat_id)->latest()->get();
        return view('user.singleproduct', compact( 'product', 'related_products'));
    }
    public function AddToCart() {

        $userid = Auth::id();
        $cart_items = Cart::where('user_id', $userid)->get();
        return view('user.addtocart', compact( 'cart_items'));
    }

    public function AddProductToCart(Request $request) {

        $product_price = $request->product_price;
        $quantity = $request->quantity;
        $price = $product_price * $quantity;

        Cart::insert([
           'product_id'     => $request->product_id,
           'user_id'        => Auth::id(),
           'quantity'       => $request->quantity,
           'product_price'  => $price,
        ]);

        return redirect()
            ->route('addtocart')
            ->with('message', 'Your item added to cart successfully');
    }

    public function RemoveCartItem($id)
    {
        Cart::findOrFail($id)->delete();
        return redirect()
            ->route('addtocart')
            ->with('message', 'Your item removed from cart successfully');
    }

    public function GetShippingAddress() {
        $id = Auth::id();
        $address = ShippingInfo::where('user_id', $id)->value('user_id');
        if (!$address){
            return view('user.shippingaddress');
        } else {
            $userid = Auth::id();
            $cartItems = Cart::where('user_id', $userid)->get();
            $shipping_address = ShippingInfo::where('user_id', $userid)->first();
            return view('user.checkout', compact('cartItems', 'shipping_address'));
        }

    }

    public function AddShippingAddress(Request $request) {
         ShippingInfo::insert([
             'user_id' => Auth::id(),
             'phone_number' => $request->phone_number,
             'city_name' => $request->city_name,
             'postal_code' => $request->postal_code
         ]);

        return redirect()
            ->route('checkout');
    }

    public function PlaceOrder()
    {
        $userid = Auth::id();
            $shipping_address = ShippingInfo::where('user_id', $userid)->first();
        $cart_items = Cart::where('user_id', $userid)->get();

        foreach ($cart_items as $item){
            Order::insert([
               'user_id' => $userid,
               'shipping_phoneNumber' => $shipping_address->phone_number,
               'shipping_city'        => $shipping_address->city_name,
               'shipping_postalcode'  => $shipping_address->postal_code,
               'product_id'           => $item->product_id,
               'quantity'             => $item->quantity,
               'total_price'          => $item->product_price
            ]);

            $id = $item->id;
            Cart::findOrFail($id)->delete();
        }

        return redirect()->route('pendingorders')
                    ->with('message', 'Your order has been placed successfully');
    }

    public function Chekout() {
        $userid = Auth::id();
        $cartItems = Cart::where('user_id', $userid)->get();
        $shipping_address = ShippingInfo::where('user_id', $userid)->first();
        return view('user.checkout', compact('cartItems', 'shipping_address'));
    }
    public function UserProfile() {
        return view('user.userprofile');
    }
    public function NewRelease() {
        return view('user.newrelease');
    }
    public function TodaysDeal() {
        return view('user.todaysdeal');
    }
    public function CustomService() {
        return view('user.customservice');
    }
    public function PendingOrder() {
        $pendingOrders = Order::where('status', 'pending')->latest()->get();
        return view('user.pendingorders', compact('pendingOrders'));
    }
    public function History() {
        return view('user.history');
    }

}
