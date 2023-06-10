<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product as pr;
use App\Models\taste;
use App\Models\SubCategory;
use App\Models\category;
use App\Models\ProductPhoto;
use App\Models\User;
use Illuminate\Http\Request;

class Product extends Controller
{

    public function search_product(Request $request){

        $keyword = $request->search;
        $name_parts = explode(" ", $keyword);

        $product = pr::query();

        foreach ($name_parts as $part) {
            $product->orWhere(function ($query) use ($part) {
                $query->where('name', 'like', "%{$part}%");
            });
        }
        if(auth()->user()->role_id == 1){
            $get = $product->orderBy('updated_at', 'desc')->paginate(10);
        }else{
            $get = $product->where('user_id', auth()->user()->id)->orderBy('updated_at', 'desc')->paginate(10);
        }
        return view('admin.products.all', compact('get'));
    }

        public function close_product(){
            if(auth()->user()->role_id == 2){
                $get =  pr::OrderBY('id', 'desc')->where('status',2)->where('user_id', auth()->user()->id)->paginate(10);
            }else{
                $get =  pr::OrderBY('id', 'desc')->where('status',2)->paginate(10);
            }
            return view('admin.products.all', compact('get'));
        }


    public function products(){
        if(auth()->user()->role_id == 2){
           $get =  pr::OrderBY('id', 'desc')->where('status',1)->where('user_id', auth()->user()->id)->paginate(10);
        }else{
            $get =  pr::OrderBY('id', 'desc')->where('status',1)->paginate(10);
        }
        return view('admin.products.all', compact('get'));
    }

    public function add_product(){
        $get_category = category::orderBY('id', 'desc')->get();
        $get_made_id = SubCategory::orderBY('id', 'desc')->get();
        $get_taste = taste::orderBY('id', 'desc')->get();
        return view('admin.products.new',compact('get_category', 'get_made_id','get_taste'));
    }

    public function create_product(Request $request){


        if ($request->made_in_id == 'null'){
            $made_in_id = null;
        }else{
            $made_in_id = $request->made_in_id;
        }
        if ($request->category_id == 7){
            $rechargeable = $request->rechargeable;
        }else{
            $rechargeable = null;
        }

     $pr =    pr::create([
           'user_id' => auth()->user()->id,
            'name' => $request->name,
            'category_id' => $request->category_id,
            'made_in_id' => $made_in_id,
            'taste_id' => $request->taste_id,
            'art' => $request->art,
            'strength' => $request->strength,
            'puffs_count' => $request->puffs_count,
            'count' => $request->count,
            'shop_id' => $request->shop_id,
            'price' => $request->price,
            'volume' => $request->volume,
            'rechargeable' => $rechargeable,
            'resistance' => $request->resistance,
            'manufacturers_recommended_power' => $request->manufacturers_recommended_power,
            'which_device_is_suitable_for_this_vaporizer' => $request->which_device_is_suitable_for_this_vaporizer,
            'output_power' => $request->output_power,
            'evaporator_resistance' => $request->evaporator_resistance,
            'cartridge_volume' => $request->cartridge_volume,
            'battery_capacity' => $request->battery_capacity,
            'equipment' => $request->equipment,
            'screen' => $request->screen,
            'replacement_coils' => $request->replacement_coils,
             'maximum_power' => $request->maximum_power,
             'battery_type' => $request->battery_type,
             'size' => $request->size,
             'capacity' => $request->capacity,
             'marking' => $request->marking,
        ]);
        if (isset($request->file)){
            $time = time();
            $destinationPath = 'uploads';
            foreach ($request->file as $image){

                $fileName = $time++.'.'.$image->getClientOriginalExtension();
                $image->move($destinationPath, $fileName);
                ProductPhoto::create([
                    'product_id' => $pr->id,
                    'photo' => $fileName
                ]);
            }
        }



        return response()->json([
           'status' => true,
           'message' => 'created'
        ],200);

    }

    public function product_page($id){
        $get_category = category::orderBY('id', 'desc')->get();
        $get_made_id = SubCategory::orderBY('id', 'desc')->get();
        $get = pr::where('id', $id)->first();
        if($get == null){
            return redirect()->back();
        }
        $get_taste = taste::orderBY('id', 'desc')->get();


        if (auth()->user()->role_id == 1){
            return view('admin.products.single', compact('get','get_category', 'get_made_id', 'get_taste'));
        }else{
            if($get->user_id == auth()->user()->id){
                return view('admin.products.single', compact('get','get_category', 'get_made_id', 'get_taste'));
            }else{
                return redirect()->back();
            }
        }
    }

    public function update_product(Request $request){
        
    $first = pr::where('id', $request->product_id)->first();
    if ($request->taste_id == 'undefined'){
        $taste_id = null;
    }else{
        $taste_id = $request->taste_id ;
    }
    if ($request->strength == 'undefined'){
        $strength = null;
    }else{
        $strength =$request->strength;
    }

    if ($request->puffs_count == 'undefined'){
        $puffs_count = null;
    }else{
        $puffs_count =$request->puffs_count;
    }

    if ($request->volume == 'undefined'){
        $volume = null;
    }else{
        $volume = $request->volume;
    }

    if ($request->rechargeable == 'undefined' ){
        $rechargeable = null;
    }else{
        $rechargeable = $request->rechargeable;
    }
    if ($request->resistance == 'undefined'){
        $resistance = null;
    }else{
        $resistance = $request->resistance;
    }

    if ($request->manufacturers_recommended_power == 'undefined'){
        $manufacturers_recommended_power = null;
    }else{
        $manufacturers_recommended_power = $request->manufacturers_recommended_power;
    }
    if ($request->which_device_is_suitable_for_this_vaporizer == 'undefined'){
        $which_device_is_suitable_for_this_vaporizer = null;
    }else{
        $which_device_is_suitable_for_this_vaporizer = $request->which_device_is_suitable_for_this_vaporizer;
    }

    if($request->output_power == 'undefined'){
        $output_power =null;
    }else{
        $output_power = $request->output_power;
    }

    if ($request->evaporator_resistance == 'undefined'){
        $evaporator_resistance = null;
    }else{
        $evaporator_resistance = $request->evaporator_resistance;
    }

    if ($request->cartridge_volume == 'undefined'){
        $cartridge_volume = null;
    }else{
        $cartridge_volume = $request->cartridge_volume;
    }

    if ($request->battery_capacity == 'undefined'){
        $battery_capacity = null;
    }else{
        $battery_capacity = $request->battery_capacity;
    }

    if ($request->equipment == 'undefined'){
        $equipment = null;
    }else{
        $equipment = $request->equipment;
    }
    if ($request->screen == 'undefined'){
        $screen = null;
    }else{
        $screen = $request->screen;
    }

    if ($request->replacement_coils == 'undefined'){
        $replacement_coils = null;
    }else{
        $replacement_coils = $request->replacement_coils;
    }

    if ($request->maximum_power == 'undefined'){
        $maximum_power = null;
    }else{
        $maximum_power = $request->maximum_power;
    }

    if($request->battery_type == 'undefined'){
        $battery_type = null;
    }else{
        $battery_type = $request->battery_type;
    }

    if ($request->size == 'undefined'){
        $size = null;
    }else{
        $size = $request->size;
    }

    if ($request->capacity == 'undefined'){
        $capacity = null;
    }else{
        $capacity = $request->capacity;
    }

    if ($request->marking == 'undefined'){
        $marking = null;
    }else{
        $marking = $request->marking;
    }



        $pr =    pr::where('id', $request->product_id)->update([
            'user_id' => $first->user_id,
            'name' => $request->name,
            'category_id' => $request->category_id,
            'made_in_id' => $request->made_in_id,
            'taste_id' => $taste_id,
            'art' => $request->art,
            'strength' =>$strength,
            'puffs_count' => $puffs_count,
            'count' => $request->count,
            'shop_id' => $request->shop_id,
            'price' => $request->price,
            'volume' => $volume,
            'rechargeable' => $rechargeable,
            'resistance' => $resistance,
            'manufacturers_recommended_power' => $manufacturers_recommended_power,
            'which_device_is_suitable_for_this_vaporizer' => $which_device_is_suitable_for_this_vaporizer,
            'output_power' => $output_power,
            'evaporator_resistance' => $evaporator_resistance ,
            'cartridge_volume' => $cartridge_volume,
            'battery_capacity' => $battery_capacity,
            'equipment' => $equipment,
            'screen' => $screen,
            'replacement_coils' => $replacement_coils,
            'maximum_power' => $maximum_power,
            'battery_type' => $battery_type,
            'size' => $size,
            'capacity' => $capacity,

            'marking' => $marking,

        ]);

        if (isset($request->file)){
            $time = time();
            $destinationPath = 'uploads';
            foreach ($request->file as $image){
                $fileName = $time++.'.'.$image->getClientOriginalExtension();
                $image->move($destinationPath, $fileName);
                ProductPhoto::create([
                    'product_id' =>  $request->product_id,
                    'photo' => $fileName
                ]);
            }
        }



        return response()->json([
            'status' => true,
            'message' => 'created',
            'product_id' => $request->product_id
        ],200);
    }

    public function delete_photo_product($id){
        ProductPhoto::where('id', $id)->delete();


        return redirect()->back()->with('deleted','deleted');
    }


    public function close_shop($id){
        pr::where('id', $id)->update([
           'status' => 2
        ]);

        return redirect()->back()->with('closed','closed');
    }

    public function open_shop($id){
        pr::where('id', $id)->update([
            'status' => 1
        ]);

        return redirect()->back()->with('opened','opened');
    }
}
