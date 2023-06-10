<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class ModeratorDeliveriController extends Controller
{
    public function new_delivery(){
        $get = Order::where('status', 1)->where('order_type', 'Drugoi')->orderby('id', 'desc')->paginate(10);
        return view('admin.Moderator.Deliveri.new', compact('get'));
    }

    public function single_delivery($id){
        $get = Order::with('OrderProduct.product.photo')->where('id', $id)->first();
        return view('admin.Moderator.Deliveri.single', compact('get'));
    }

    public function delivery_delivery(){
        $get = Order::where('status', 2)->where('order_type', 'Drugoi')->orderby('id', 'desc')->paginate(10);
        return view('admin.Moderator.Deliveri.new', compact('get'));
    }

    public function delivers_delivery(){
        $get = Order::where('status', 3)->where('order_type', 'Drugoi')->orderby('id', 'desc')->paginate(10);
        return view('admin.Moderator.Deliveri.new', compact('get'));
    }

    public function confirmed_delivery(){
        $get = Order::where('status', 4)->where('order_type', 'Drugoi')->orderby('id', 'desc')->paginate(10);
        return view('admin.Moderator.Deliveri.new', compact('get'));
    }

    public function deliveryd($id){
        Order::where('id', $id)->update([
           'status'  => 4
        ]);


        return redirect()->back();
    }
}
