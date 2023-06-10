<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewOrderFromShop;

class ModeratorShopController extends Controller
{

    public function new_shops(){
        $get = Order::where('status', 1)->where('order_type', 'Shops')->orderby('id', 'desc')->paginate(10);
        return view('admin.Moderator.Shops.new', compact('get'));
    }

    public function old_shops(){
        $get = Order::where('status', 2)->orwhere('status', 3)->where('order_type', 'Shops')->orderby('id', 'desc')->paginate(10);
        return view('admin.Moderator.Shops.new', compact('get'));
    }

    public function single_new_shop($id){
        $get = Order::with('OrderProduct.product.photo')->where('id', $id)->first();
        return view('admin.Moderator.Shops.single', compact('get'));
    }


    public function success_new_shop($id){


        $get = Order::where('id', $id)->first();
        if ($get == null){
            return redirect()->back();
        }


        $order_product = OrderProduct::where('order_id', $get->id)->get('shop_id')->pluck('shop_id')->toarray();



        $uniq  = array_unique($order_product);


        $get_user = User::wherein('id', $uniq)->where('email','!=', null)->get('email')->pluck('email')->toarray();


        $details =[
            'order_id' => $get->order_id,
            'email' => $get->email,
            'name' => $get->name,
            'phone' => $get->phone,
            'promo_code' => $get->promo_code,
            'url' => route('ShowNewShopDetails',$get->id),
        ];


        foreach ($get_user as $email){
           Mail::to($email)->send(new NewOrderFromShop($details));
        }

        Order::where('id', $id)->update([
           'status' => 2
        ]);

        return redirect()->back()->with('confirmed_from_admin','confirmed_from_admin');
    }
}
