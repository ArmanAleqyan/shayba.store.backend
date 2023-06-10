<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\taste as tast;
use App\Models\category;
use App\Models\SubCategory;
use App\Models\taste_category;
use App\Models\taste_made_in;

class Taste extends Controller
{

    public function delete_taste($id){
        tast::where('id', $id)->delete();
        return redirect()->route('all_taste');
    }


    public function all_taste(Request $request){

        $get = tast::orderBy('id', 'desc')->paginate(10);
        return view('admin.Taste.all', compact('get'));
    }

    public function search_all_taste(Request $request){

        $keyword = $request->search;
        $name_parts = explode(" ", $keyword);

        $users = tast::query();

        foreach ($name_parts as $part) {
            $users->orWhere(function ($query) use ($part) {
                $query->where('name', 'like', "%{$part}%");
            });
        }

        $get = $users->paginate(10);

        return view('admin.Taste.all', compact('get'));

    }

    public function new_all_taste(){
        $get = category::orderBy('id','Desc')->get();
        $get_made_in = SubCategory::orderBy('id','Desc')->get();
        return view('admin.Taste.new',compact('get','get_made_in'));
    }

    public function add_new_taste(Request $request){

        $create = tast::create([
           'name' => $request->name
        ]);
        
        if(isset($request->category_id)){
            foreach ($request->category_id as $item) {
                taste_category::create([
                    'taste_id' => $create->id,
                    'category_id' => $item
                ]);
            }
        }
        if (isset($request->made_in_id)){
            foreach ($request->made_in_id as $made_in_id) {
                taste_made_in::create([
                    'taste_id' => $create->id,
                    'made_in_id' => $made_in_id
                ]);
            }
        }
        return redirect()->back()->with('added','added');
    }


    public function single_page_taste($id){
        $getTaste =  tast::where('id', $id)->first();

        if($getTaste == null){
            return redirect()->back();
        }

        $gettaste_category = taste_category::where('taste_id',$id) ->get('category_id')->pluck('category_id')->toarray();
        $getSubbCategory = taste_made_in::where('taste_id', $id)->get('made_in_id')->pluck('made_in_id')->toarray();

        $getcategory = category::orderBy('id','Desc')->wherenotIn('id',$gettaste_category)->get();
        $getcategory2 = category::orderBy('id','Desc')->whereIn('id',$gettaste_category)->get();

        $getSubCategory = SubCategory::orderBy('id','Desc')->whereNotIn('id', $getSubbCategory)->get();
        $getSubCategory2 = SubCategory::orderBy('id','Desc')->whereIn('id', $getSubbCategory)->get();

return view('admin.Taste.single',compact('getTaste', 'getcategory','getcategory2','getSubCategory','getSubCategory2'));
    }

    public function update_taste(Request $request){
        tast::where('id', $request->taste_id)->update([
           'name' => $request->name
        ]);
        if(isset($request->category_id)){
            foreach ($request->category_id as $item) {
                taste_category::create([
                    'taste_id' =>  $request->taste_id,
                    'category_id' => $item
                ]);
            }
        }
        if (isset($request->made_in_id)){
            foreach ($request->made_in_id as $made_in_id) {
                taste_made_in::create([
                    'taste_id' => $request->taste_id,
                    'made_in_id' => $made_in_id
                ]);
            }
        }
        return redirect()->back()->with('updated','updated');
    }


    public function delete_made_in_from_taste($id,$taste_id){

        taste_made_in::where('taste_id',$taste_id)->where('made_in_id', $id)->delete();

        return redirect()->back();

    }
    public function delete_category_from_taste($id,$taste_id){

        taste_category::where('taste_id',$taste_id)->where('category_id', $id)->delete();

        return redirect()->back();

    }
}
