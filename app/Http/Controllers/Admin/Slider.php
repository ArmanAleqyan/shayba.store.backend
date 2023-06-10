<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider as sl;

class Slider extends Controller
{
    public function all_slider(){

       $get = sl::orderbY('updated_at', 'desc')->orderby('order_by', 'asc')->paginate(10);
        return view('admin.Slider.all', compact('get'));
    }

    public function new_slider(){


        return view('admin.Slider.new');
    }

    public function create_slider(Request $request){


        $image = $request->photo;
        $destinationPath = 'uploads';
        if(isset($image)){
            $time = time();
            $fileName = $time++.'.'.$image->getClientOriginalExtension();
            $image->move($destinationPath, $fileName);
        }else{
            $fileName = null;
        }

        $sl = sl::create([
           'title' => $request->title,
            'sub_title' => $request->sub_title,
            'description' => $request->description,
            'photo' => $fileName,
            'order_by' => $request->order_by
        ]);

            return  redirect()->back()->with('added','added');
    }



    public function single_page_slider($id){

        $get = sl::where('id', $id)->first();
        if($get == null){
            return redirect()->back();
        }else{
            return view('admin.Slider.single', compact('get'));
        }
    }

    public function update_slider(Request $request){
        $get = sl::where('id', $request->slider_id)->first();

        if ($get == null){
            return redirect()->back();
        }

        $get->update([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'description' => $request->description,
            'order_by' => $request->order_by
        ]);


        $image = $request->photo;
        $destinationPath = 'uploads';
        if(isset($image)){
            $time = time();
            $fileName = $time++.'.'.$image->getClientOriginalExtension();
            $image->move($destinationPath, $fileName);

            $get->update([
               'photo' => $fileName
            ]);
        }
        return redirect()->back()->with('added','added');
    }

    public function close_slider($id){
        sl::where('id',$id)->update([
           'status' => 2
        ]);

        return redirect()->back();
    }

    public function open_slider($id){
        sl::where('id',$id)->update([
            'status' => 1
        ]);

        return redirect()->back();
    }
}
