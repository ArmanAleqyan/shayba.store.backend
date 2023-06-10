<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests\AddNewShopRequest;
use App\Http\Requests\UpdateAdminUser;
use Illuminate\Support\Facades\Hash;

class TheShops extends Controller
{
    public function the_shops(){
        $getUser = User::OrderBy('id','desc')->where('role_id', 2)->paginate(10);

        return view('admin.users.Admins', compact('getUser'));
    }

    public function new_shop($id = null){
        if ($id == null){
            return view('admin.users.NewAdmin');
        }
    }

    public function add_new_shop(AddNewShopRequest $request){


            $user = User::create([
               'name' => $request->name,
               'password' => Hash::make($request->password),
               'shop_id' => $request->shop_id,
               'phone' => $request->phone,
               'email' => $request->email,
                'address' => $request->address,
                'role_id' => 2
            ]);

            return redirect()->back()->with('added','added');
    }

    public function single_page_user($id){
        $get = User::where('id', $id)->first();

        if($get == null){
            return redirect()->back();
        }else{
            return view('admin.users.single_page_user',compact('get'));
        }
    }

    public function update_user_admin (UpdateAdminUser $request){


        if($request->password != null){
            User::where('id', $request->user_id)->update(['password' => Hash::make($request->password)]);
        }
        User::where('id', $request->user_id)->update([
            'name' => $request->name,
            'phone' => $request->phone,
//            'password' => Hash::make($request->password),
            'shop_id' => $request->shop_id,
            'email' => $request->email,
            'address' => $request->address,
            'role_id' => 2
        ]);


        return redirect()->back()->with('updated','updated');
    }
}
