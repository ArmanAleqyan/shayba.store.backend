<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
class ShopCOntroller extends Controller
{
    public function ShowNewShop(){
    $get = Order::whereRelation('OrderProduct','shop_id', auth()->user()->id)->where('order_type', 'Shops')->where('status',2)->with('OrderProduct')->paginate(10);

//    dd(auth()->user());
//    dd($getOrder);

        return view('admin.Moderator.Shops.new', compact('get'));
    }

    public function ShowOldShop(){
        $get = Order::whereRelation('OrderProduct','shop_id', auth()->user()->id)->where('order_type', 'Shops')->where('status',3)->with('OrderProduct')->paginate(10);

//    dd(auth()->user());
//    dd($getOrder);

        return view('admin.Moderator.Shops.new', compact('get'));
    }
    public function ShowNewShopDetails($id){
        $get = Order::with('OrderProduct.product.photo')->where('id', $id)->first();

        return view('admin.Moderator.Shops.single', compact('get'));
    }

    public function ShowNewShopDetailSuccess($id){
        Order::where('id', $id)->update([
           'status' => 3
        ]);

        return redirect()->back();
    }

    public function NewDelivery(){

        $get = Order::whereRelation('OrderProduct','shop_id', auth()->user()->id)->where('order_type', 'Drugoi')->where('status',2)->with('OrderProduct')->paginate(10);

        return view('admin.Moderator.Deliveri.new', compact('get'));
    }
    public function DeliveryDelivery(){

        $get = Order::whereRelation('OrderProduct','shop_id', auth()->user()->id)->where('order_type', 'Drugoi')->where('status',3)->with('OrderProduct')->paginate(10);


        return view('admin.Moderator.Deliveri.new', compact('get'));
    }
    public function ConfirmedDeliveryDelivery(){
        $get = Order::whereRelation('OrderProduct','shop_id', auth()->user()->id)->where('order_type', 'Drugoi')->where('status',4)->with('OrderProduct')->paginate(10);

        return view('admin.Moderator.Deliveri.new', compact('get'));
    }

    public function SingleNewDelivery($id){
        $get = Order::with('OrderProduct.product.photo')->where('id', $id)->first();
        return view('admin.Moderator.Deliveri.single', compact('get'));
    }
}
