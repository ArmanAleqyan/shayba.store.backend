<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SendCallCount;
use GreenSMS\GreenSMS;
use Carbon\Carbon;
use Illuminate\Http\Request;



use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;


class Registration extends Controller
{


    /**
     * @OA\Get(
     * path="/api/saite_header_and_footer_info",
     * summary="saite_header_and_footer_info",
     * description="saite_header_and_footer_info",
     * operationId="saite_header_and_footer_info",
     * tags={"SaayteInfo"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user register",
     *    @OA\JsonContent(
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="register created",
     *    @OA\JsonContent(
     *        )
     *     )
     * )
     */

    public  function saite_header_and_footer_info(){
        $get = \App\Models\ShopDescription::first();


        return response()->json([
           'status' => true,
           'data' => $get
        ],200);
    }
    /**
     * @OA\Post(
     * path="/api/registration",
     * summary="registration",
     * description="registration",
     * operationId="registration",
     * tags={"Auth"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user register",
     *    @OA\JsonContent(
     *       @OA\Property(property="phone", type="string", format="text", example="93073584"),
     *       @OA\Property(property="name", type="string", format="text", example="Arman"),
     *       @OA\Property(property="password", type="string", format="text", example="password"),
     *       @OA\Property(property="password_confirmation", type="string", format="text", example="password_confirmation"),
     *
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="register created",
     *    @OA\JsonContent(
     *        )
     *     )
     * )
     */
    public function registration(Request $request){


        $rules=array(
            'phone'  =>"required|max:254",
            'name'  =>"required|max:254",
            'password' => 'min:6|max:254|required',
            'password_confirmation' => 'required_with:password|same:password|min:6|max:254'
        );

        $messages = [
            'phone.required' => 'Обезателное поле',
            'name.required' => 'Обезателное поле',
            'password.min' => 'Пароль должен состоять минимум из 6-ти символов',
            'password.required' => 'Обезателное поле',
            'password_confirmation.required_with' => 'Пароли не совпадают',
            'password_confirmation.same' => 'Пароли не совпадают ',
            'password_confirmation.min' => 'Пароли не совпадают '
        ];
        $validator=Validator::make($request->all(),$rules,$messages);
        if($validator->fails())
        {
            return response()->json([
               'status' => false,
               'message' =>$validator->errors()
            ],422);
        }

        $sendcallnumber =   preg_replace('/[^0-9]/', '', $request->phone);

            $getUserValid = User::where('phone',$sendcallnumber)->where('phone_verify', 1)->first();

            if ($getUserValid != null){
                return response()->json([
                   'status' => false,
                    'message' => 'Такой акаунт уже сушествует'
                ],422);
            }


        $client = new GreenSMS([
            'user' => env('green_login'),
            'pass' => env('green_password')
        ]);
        $balance = $client->account->balance();
        if($balance->balance <  1){
            return response()->json([
               'status' => false,
               'message' => 'Извините у нас Северная ошибка пожалуйста Попробуйте немного позднее'
            ],422);
        }



        $callCOunt = SendCallCount::where('phone',$sendcallnumber )->where('status', 'reg')->latest()->first();
        $callCOunt2 = SendCallCount::where('phone',$sendcallnumber )->where('status', 'reg')->where('created_at' ,'>',Carbon::now()->subMinutes(10))->orderBy('id','desc')->limit(3)->get();
        if($callCOunt2->count() == 3){
            return response()->json([
               'status' => false,
               'message' => 'Ваш аккаунт заблокирован на 10 минут'
            ],422);
        }
        if(isset($callCOunt->created_at) && $callCOunt->created_at > Carbon::now()->subMinute()){
            return response()->json([
                'status' => false,
                'message' => 'Попробуйте через минуту'
            ],422);
        }

            try{
                $response = $client->call->send(['to' =>$sendcallnumber]);
            }catch (\Exception $e){
                return response()->json([
                       'status' => false,
                       'message' =>  'Неверный формат номера телефона пожалуйста введите правильный формат'
                 ],422);
            }


        $getUser = User::where('phone', $sendcallnumber)->first();
        if($getUser == null){
            User::create([
               'name' => $request->name,
               'phone' => $sendcallnumber,
               'password'  => Hash::make($request->password),
               'role_id' => 3,
               'phone_verify' => $response->code
            ]);
        }else{
            User::where('phone', $sendcallnumber)->update([
                'phone_verify' =>  $response->code
            ]);
            return response()->json([
                'status' => true,
                'message' => 'user creted code sended yor phone number'
            ],200);
        }
        SendCallCount::create([
            'phone' => $sendcallnumber,
            'status' => 'reg',
        ]);
        return response()->json([
           'status'  => true,
            'message' => 'user creted code sended yor phone number'
        ],200);

    }

    /**
     * @OA\Post(
     * path="/api/confirm_registration",
     * summary="confirm_registration",
     * description="confirm_registration",
     * operationId="confirm_registration",
     * tags={"Auth"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user register",
     *    @OA\JsonContent(
     *       @OA\Property(property="phone", type="string", format="text", example="93073584"),
     *       @OA\Property(property="phone_verify", type="string", format="text", example="1111"),
     *
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="register created",
     *    @OA\JsonContent(
     *        )
     *     )
     * )
     */

    public function confirm_registration(Request $request){

        
        $rules=array(
            'phone'  =>"required|max:254",
            'phone_verify'  =>"required|min:4|max:4",
        );

        $messages = [
            'phone.required' => 'Обезателное поле',
            'phone_verify.required' => 'Обезателное поле',
            'phone_verify.min' => 'Поле Должно сосстоять из 4х символов',
            'phone_verify.max' => 'Поле Должно сосстоять из 4х символов',
        ];
        $validator=Validator::make($request->all(),$rules,$messages);
        if($validator->fails())
        {

            return response()->json([
               'status' => false,
               'message' => $validator->errors()
            ],422);
//            return ;
        }
        $sendcallnumber =   preg_replace('/[^0-9]/', '', $request->phone);
        $get = User::where('phone_verify', $request->phone_verify)->where('phone', $sendcallnumber)->first();
        if($get == null){
            return response()->json([
               'status'  => false,
                'message' => 'Неправельный код потверждения'
            ],422);
        }else{
            $get->update([
               'phone_verify' => 1
            ]);
            Auth::login($get);
            $token =   $get->createToken('Laravel Password Grant Client')->accessToken;
            return response()->json([
               'status' => true,
               'message' => 'user verify',
                'token' => $token,
                'user' => $get
            ],200);
        }
    }
}
