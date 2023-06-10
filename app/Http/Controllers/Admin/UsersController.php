<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function add_bonuse_from_user(Request $request){
        User::where('id', $request->user_id)->update([
           'bonus' => $request->bonus
        ]);


        return redirect()->back();
    }

    public function all_users(){
        $getUser = User::where('role_id', 3)->orderby('id', 'desc')->paginate(10);
        $getUserCount = User::where('role_id', 3)->count();
        return view('admin.AppUsers.all', compact('getUser','getUserCount'));
    }

    public function success_register($id){
        User::where('id', $id)->update([
            'phone_verify' => 1
        ]);


        return redirect()->back();
    }

    public function app_user_single_page($id){
        $get = User::where('id', $id)->first();

        if ( $get == null){
            return redirect()->back();
        }

        return view('admin.AppUsers.single',compact('get'));
    }


    public function search_user(Request $request){
        $getUserCount = User::where('role_id', 3)->count();
        $keyword = $request->search;
        $name_parts = explode(" ", $keyword);

        $get = User::query();
        foreach ($name_parts as $part) {
            $get->orWhere(function ($query) use ($part) {
                $query->where('name', 'like', "%{$part}%")->orwhere('email', 'like', "%{$part}%")->orwhere('phone', 'like', "%{$part}%");
            });
        }
        $getUser =$get->where('role_id', 3)->orderby('id', 'desc')->paginate(10);

        return view('admin.AppUsers.all', compact('getUser','getUserCount'));


    }

}
