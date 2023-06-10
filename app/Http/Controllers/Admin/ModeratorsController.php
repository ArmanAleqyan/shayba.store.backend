<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\NewModeratorRequest;
use App\Http\Requests\UpdateModeratorRequest;
use Illuminate\Support\Facades\Hash;

class ModeratorsController extends Controller
{
    public function all_moderators(){
        $get = User::where('role_id', 4)->orderbY('id', 'desc')->paginate();
        return view('admin.Moderators.all',compact('get'));
    }

    public function new_moderator(){
        return view('admin.Moderators.new');
    }

    public function add_new_moderator(NewModeratorRequest $request){


        User::create([
            'Name' => 'Модератор',
           'email' => $request->email,
           'phone' => $request->phone,
           'password' => Hash::make($request->password),
            'role_id' => 4
        ]);


    return redirect()->back()->with('added','added');
    }

    public function single_page_moderator ($id){
        $get = User::where('id', $id)->first();

        return view('admin.Moderators.single', compact('get'));
    }

    public function update_moderator(UpdateModeratorRequest $request){
            User::where('id', $request->user_id)->update([
               'email' => $request->email,
               'phone' => $request->phone,
            ]);

            if (isset($request->password)){
                User::where('id', $request->user_id)->update([
                        'password' => Hash::make($request->password)
                ]);
            }


            return redirect()->back()->with('updated','updated');
    }

    public function delete_moderator($id){
        User::where('id', $id)->delete();

        return redirect()->route('all_moderators')->with('deleted','deleted');
    }
}
