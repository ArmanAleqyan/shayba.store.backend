<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Models\SendCallCount;
use GreenSMS\GreenSMS;
class Login extends Controller
{


    /**
     * @OA\Post(
     * path="/api/login",
     * summary="login",
     * description="login",
     * operationId="login",
     * tags={"Auth"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user register",
     *    @OA\JsonContent(
     *       @OA\Property(property="phone", type="string", format="text", example="93073584"),
     *       @OA\Property(property="password", type="string", format="text", example="password"),
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
    public function login(Request $request){
        $rules=array(
            'phone'  =>"required|max:254",
            'password'  =>"required",
        );
        $messages = [
            'phone.required' => 'Обязательное поле',
            'password.required' => 'Обязательное поле',
        ];

        $validator=Validator::make($request->all(),$rules,$messages);



        if($validator->fails())
        {

            return response()->json([
               'status' => false,
               'message' => $validator->errors()
            ],422);
        }

        $sendcallnumber =   preg_replace('/[^0-9]/', '', $request->phone);

        $credentials = $request->only( 'password');
        $credentials['phone'] = $sendcallnumber;
        $auth = Auth::attempt($credentials);



        if($auth == false){
            return response()->json([
               'status' => false,
               'message' => 'Неправильный номер или пароль',
            ],422);
        }else{
            $token =   auth()->user()->createToken('Laravel Password Grant Client')->accessToken;

            if(auth()->user()->phone_verify != 1){
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
                $callCOunt = SendCallCount::where('phone',$sendcallnumber )->where('status', 'login')->latest()->first();
                $callCOunt2 = SendCallCount::where('phone',$sendcallnumber )->where('status', 'login')->where('created_at' ,'>',Carbon::now()->subMinutes(10))->orderBy('id','desc')->limit(3)->get();
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
                        'message' =>  'Введите корректный номер телефона'
                    ],422);
                }
                auth()->user()->update([
                   'phone_verify' => $response->code
                ]);
                SendCallCount::create([
                    'phone' => $sendcallnumber,
                    'status' => 'login',
                ]);
                return response()->json([
                   'status' => false,
                   'message' => 'no verify user'
                ],422);
            }
            return response()->json([
               'status' => true,
               'message' => 'User Logined',
               'user' => auth()->user(),
               'token' => $token
            ],200);
        }
    }

    /**
     * @OA\Post(
     * path="/api/forgot_password",
     * summary="forgot_password",
     * description="forgot_password",
     * operationId="forgot_password",
     * tags={"ForgotPassword"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user register",
     *    @OA\JsonContent(
     *       @OA\Property(property="phone", type="string", format="text", example="93073584"),
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
    public function forgot_password(Request $request){
        $rules=array(
            'phone'  =>"required|max:254",
        );
        $messages = [
            'phone.required' => 'Обязательное поле',
        ];

        $validator=Validator::make($request->all(),$rules,$messages);
        if($validator->fails())
        {

            return response()->json([
               'status' => false,
               'message' => $validator->errors()
            ],422);

        }

        $sendcallnumber =   preg_replace('/[^0-9]/', '', $request->phone);
      $valid =   User::where('phone', $sendcallnumber)->first();

      if ($valid == null){
          return response()->json([
             'status' => false,
             'message' =>  'Такой номер телефона не существует'
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
        $callCOunt = SendCallCount::where('phone',$sendcallnumber )->where('status', 'forgot_password')->latest()->first();
        $callCOunt2 = SendCallCount::where('phone',$sendcallnumber )->where('status', 'forgot_password')->where('created_at' ,'>',Carbon::now()->subMinutes(10))->orderBy('id','desc')->limit(3)->get();
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
                'message' =>  'Введите корректный номер телефона'
            ],422);
        }
        User::where('phone', $sendcallnumber)->update([
            'forgot_password_with_phone' => $response->code

        ]);

        SendCallCount::create([
            'phone' => $sendcallnumber,
            'status' => 'forgot_password',
        ]);

        return response()->json([
           'status' => true,
           'message' => 'code sended your phone number'
        ],200);

    }
    /**
     * @OA\Post(
     * path="/api/validation_forgot_password_code",
     * summary="validation_forgot_password_code",
     * description="validation_forgot_password_code",
     * operationId="validation_forgot_password_code",
     * tags={"ForgotPassword"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user register",
     *    @OA\JsonContent(
     *       @OA\Property(property="phone", type="string", format="text", example="93073584"),
     *       @OA\Property(property="phone_verify", type="string", format="text", example="1234"),
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
    public function validation_forgot_password_code(Request $request){
     

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
               'status'  => false,
               'message' => $validator->errors()
            ],422);
        }



        $sendcallnumber =   preg_replace('/[^0-9]/', '', $request->phone);
        $user = User::where('phone',$sendcallnumber)->where('forgot_password_with_phone',$request->phone_verify)->first();
        if($user == null){
            return response()->json([
               'status' => false,
               'message' => 'Неправильный код подтверждения'
            ],422);
        }else{
            return response()->json([
                'status' => true,
                'message' => 'code success save this code in your regexp from next function'
            ],200);
        }
    }
    /**
     * @OA\Post(
     * path="/api/add_new_password",
     * summary="add_new_password",
     * description="add_new_password",
     * operationId="add_new_password",
     * tags={"ForgotPassword"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user register",
     *    @OA\JsonContent(
     *       @OA\Property(property="phone", type="string", format="text", example="93073584"),
     *       @OA\Property(property="phone_verify", type="string", format="text", example="1234"),
     *       @OA\Property(property="password", type="string", format="text", example="123456"),
     *       @OA\Property(property="password_confirmation", type="string", format="text", example="123456"),
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
    public function add_new_password(Request $request){
        $rules=array(
            'phone'  =>"required|max:254",
            'phone_verify'  =>"required|min:4|max:4",
            'password' => 'min:6|max:254|required',
            'password_confirmation' => 'required_with:password|same:password|min:6|max:254'
        );

        $messages = [
            'phone.required' => 'Обезателное поле',
            'phone_verify.min' => 'Поле Должно сосстоять из 4х символов',
            'phone_verify.max' => 'Поле Должно сосстоять из 4х символов',
            'password.min' => 'Поле должно состоять минимально из 6-и символов',
            'password.required' => 'Обезателное поле',
            'password_confirmation.required_with' => 'Пароль не совпадает',
            'password_confirmation.same' => 'Пароль не совпадает',
            'password_confirmation.min' => 'Пароль не совпадает'
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

        User::where('phone',$sendcallnumber)->where('forgot_password_with_phone' , $request->phone_verify)->update([
            'forgot_password_with_phone' => null,
            'password' => Hash::make($request->password)
        ]);


        return response()->json([
           'status' => true,
           'message' => 'Пароль успешно обновлён'
        ],200);
    }


    /**
     * @OA\Post(
     * path="/api/logout",
     * summary="logout",
     * description="logout",
     * operationId="logout",
     * tags={"Auth"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user register",
     *    @OA\JsonContent(
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
    public function logout(Request $request){
        $user = auth()->guard('api')->user()->token();
        $user->revoke();

        return response()->json([
           'status' => true,
           'message' => 'User Logouted'
        ],200);
    }

}
