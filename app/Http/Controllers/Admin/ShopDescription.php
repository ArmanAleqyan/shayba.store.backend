<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShopDescription as desc;
use GreenSMS\GreenSMS;

class ShopDescription extends Controller
{

    public function ShopDescription(){
            $get = desc::first();

        $client = new GreenSMS([
            'user' => env('green_login'),
            'pass' => env('green_password')
        ]);
        $balance = $client->account->balance()->balance;
        
        return view('admin.ShopInfo.update', compact('get','balance'));
    }


    public function update_shop_description(Request $request){
        $get = desc::where('id', $request->get_id)->first();

        if ($get == null){
            return redirect()->back();
        }


        if (isset($request->header_phone)){
            $get->update([
               'header_phone' => $request->header_phone
            ]);
        }
        if (isset($request->vk_url)){
            $get->update([
               'vk_url' => $request->vk_url
            ]);
        }
        if (isset($request->instagram_url)){
            $get->update([
               'instagram_url' => $request->instagram_url
            ]);
        }
        if (isset($request->watsap_url)){
            $get->update([
               'watsap_url' => $request->watsap_url
            ]);
        }
        if (isset($request->telegram_url)){
            $get->update([
               'telegram_url' => $request->telegram_url
            ]);
        }
        if (isset($request->footer_email)){
            $get->update([
               'footer_email' => $request->footer_email
            ]);
        }
        if (isset($request->footer_address)){
            $get->update([
               'footer_address' => $request->footer_address
            ]);
        }
        if (isset($request->footer_phone)){
            $get->update([
               'footer_phone' => $request->footer_phone
            ]);
        }
        if (isset($request->info_o_nas)){
            $get->update([
               'info_o_nas' => $request->info_o_nas
            ]);
        }
        if (isset($request->footer_first_text)){
            $get->update([
               'footer_first_text' => $request->footer_first_text
            ]);
        }
        if (isset($request->file_pdf)){
            $destinationPath = 'uploads';
            $fileName = time().'.'.$request->file_pdf->getClientOriginalExtension();
            $request->file_pdf->move($destinationPath, $fileName);
            $get->update([
                'policy_file_url' => 'https://admin.shayba.store/uploads/'.$fileName
            ]);
        }

        return redirect()->back()->with('added','added');
    }
}
