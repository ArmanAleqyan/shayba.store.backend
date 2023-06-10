<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category as cat;

class Category extends Controller
{

    public function delete_category($id){
        cat::where('id', $id)->delete();

        return redirect()->route('category');
    }

    public function category($id = null){
        if($id == null){
            $get  = cat::orderbY('id', 'desc')->paginate(10);
            return view('admin.category.all',compact('get'));
        }else{
            $get = cat::where('id', $id)->first();

            if($get != null){
                return view('admin.category.single', compact('get'));
            }else{
                return redirect()->back();
            }

        }
    }

    public function new_category(){
        return view('admin.category.new');
    }

    public function add_new_category(Request $request){


        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $fileName);
            cat::create([
               'name' => $request->name,
               'photo' =>  $fileName
            ]);

            return redirect()->back()->with('added','added');
        }else{
            return redirect()->back()->with('error','error');
        }
    }


    public function update_category(Request $request){
        $get = cat::where('id', $request->category_id)->first();
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $fileName);
        }else{
            $fileName =  $get ->photo;
        }

        $get->update([
            'name' => $request->name,
            'photo' =>  $fileName
        ]);

        return redirect()->back()->with('updated','updated');
    }



}
