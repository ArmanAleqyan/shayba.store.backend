<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory as sub;
use App\Models\category;
use App\Models\MadeInCategoryId;

class SubCategory extends Controller
{

    public function delete_sub_category($id){
        sub::where('id', $id)->delete();
        return redirect()->route('all_sub_category');
    }

    public function all_sub_category(){
        $get = sub::orderby('id','desc')->paginate(1000);

        return view('admin.subCategory.all',compact('get'));
    }

    public function new_sub_category(){
        $get = category::orderBy('id','Desc')->get();
        return view('admin.subCategory.new',compact('get'));
    }

    public function add_new_sub_category(Request $request){


        $get = sub::create([
            'name' => $request->name,
        ]);

        if(isset($request->category_id )){
            foreach ($request->category_id as $cat){
                MadeInCategoryId::create([
                    'category_id' =>$cat,
                    'made_in_id' =>  $get->id,
                ]);
            }
        }
        return redirect()->back()->with('added','added');
    }

    public function single_page_sub_category($id){
        $get =  sub::where('id', $id)->first();
        $getMyCat = MadeInCategoryId::where('made_in_id',$id)->get('category_id')->pluck('category_id')->toarray();

        $getCategory = category::whereNotin('id', $getMyCat)->get();
        $getCategory2 = category::orderby('id','desc')->wherein('id', $getMyCat)->get();

        if($get == null){
            return redirect()->back();
        }

        return view('admin.subCategory.single',compact('get','getCategory','getCategory2'));
    }

    public function update_sub_category(Request $request){
        sub::where('id', $request->sub_id)->update([
           'name' => $request->name,
        ]);


        if(isset($request->category_id )){
            foreach ($request->category_id as $cat){
                MadeInCategoryId::create([
                    'category_id' =>$cat,
                    'made_in_id' => $request->sub_id,
                ]);
            }
        }


        return redirect()->back()->with('updated','updated');
    }

    public function delete_category_id_from_made_in($id, $made_id){

        MadeInCategoryId::where('category_id',$id)->where('made_in_id', $made_id)->delete();

        return redirect()->back();
    }

}
