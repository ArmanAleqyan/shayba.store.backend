<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Validator;
use App\Mail\NewEmail;
use App\Mail\UserFedback;
use App\Models\ShopingBasket;
use App\Models\FavoriteProduct ;

class MyCabinet extends Controller
{


    public function user_feedback(Request $request){
        $rules=array(
            'name'  =>"required",
            'email' => 'email|max:254|required',
            'phone' => 'required|max:254',
            'address' => 'required'
        );
        $messages = [
            'name.required' => 'Обязательное поле',
            'email.required' => 'Обязательное поле',
            'phone.required' => 'Обязательное поле',
            'address.required' => 'Обязательное поле',
            'email.email' => 'Неверный формат Эл почты',
        ];

        $validator=Validator::make($request->all(),$rules,$messages);
        if($validator->fails())
        {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ],422);
        }

        $details = [
          'email' => $request->email,
          'phone' => $request->phone,
          'address' => $request->address,
          'name' => $request->name,
        ];
        $get_admin = User::where('role_id', 1)->first();

        Mail::to($get_admin->email)->send(new UserFedback($details));

        return response()->json([
           'status' => true,
           'message' => 'Наш администратор свяжется с Вами'
        ],200);
    }

    /**
     * @OA\Post(
     * path="/api/add_new_password2",
     * summary="add_new_password2",
     * description="add_new_password2",
     * operationId="add_new_password2",
     * tags={"MyCabinet"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user register",
     *    @OA\JsonContent(
     *       @OA\Property(property="old_password", type="string", format="text", example="old_password"),
     *       @OA\Property(property="password", type="string", format="text", example="password"),
     *       @OA\Property(property="password_confirmation", type="string", format="text", example="password_confirmation"),
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


    public function add_new_password2(Request $request){
        $rules=array(
            'old_password'  =>"required",
            'password' => 'min:6|max:254|required',
            'password_confirmation' => 'required_with:password|same:password|min:6|max:254'
        );
        $messages = [
            'old_password.required' => 'Обязательное поле',
            'password.min' => 'Пароль должен состоять минимум из 6-ти символов',
            'password.required' => 'Обязательное поле',
            'password_confirmation.required_with' => 'Пароли не совпадают',
            'password_confirmation.same' => 'Пароли не совпадают',
            'password_confirmation.min' => 'Пароль должен состоять минимум из 6-ти символов'
        ];

        $validator=Validator::make($request->all(),$rules,$messages);
        if($validator->fails())
        {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ],422);
        }
        $chack_password  =  Hash::check($request->old_password,  auth()->user()->getAuthPassword());
        if($chack_password == true){
            auth()->user()->update([
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Password Updated'
            ],200);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Неверный пароль'
            ],422);
        }


    }

    /**
     * @OA\Get(
     * path="/api/auth_user_info",
     * summary="auth_user_info",
     * description="auth_user_info",
     * operationId="auth_user_info",
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

    public function auth_user_info(){
        $get = auth()->user();
        $basketCount =   ShopingBasket::where('user_id',  auth()->user()->id)->sum('count');
        $basketPrice =   ShopingBasket::where('user_id',  auth()->user()->id)->with('productBelngsto')->get();
        $favorite_count = FavoriteProduct::where('user_id', \auth()->user()->id)->count();
        $totalValue = $basketPrice->sum(function ($item) {
            return $item->productBelngsto->price * $item->count;
        });
        if (\auth()->user()->bonus > 0 && $totalValue > 0){
            $bonus_monus = explode('.',$totalValue * auth()->user()->bonus /100)[0];
            $totalValue = $totalValue-$bonus_monus;
        }else{
            $bonus_monus  = null;
        }
        
        return response()->json([
           'status' => true,
           'data' => $get,
           'BasketCount' => $basketCount,
            'BasketSum' => $totalValue,
            'Favorite_Count' => $favorite_count,
            'bonus_monus' =>  $bonus_monus,
            'bonus_count' => auth()->user()->bonus
        ]);
    }


    /**
     * @OA\Post(
     * path="/api/add_new_email",
     * summary="add_new_email",
     * description="add_new_email",
     * operationId="add_new_email",
     * tags={"MyCabinet"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user register",
     *    @OA\JsonContent(
     *       @OA\Property(property="email", type="string", format="text", example="email"),
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


    public function add_new_email(Request $request){
        $rules=array(
            'email'  =>"required|max:254|email|unique:users"
        );
        $messages = [
            'email.required' => 'Обязательное поле',
            'email.max' => 'Поле Должно сосстоять из 254х символов',
            'email.email' => 'Неверный формат Эл Почты',
            'email.unique' => 'Такая электронная почта уже существует'
        ];

        $validator=Validator::make($request->all(),$rules,$messages);
        if($validator->fails())
        {
            return response()->json([
                'status' => false,
               'message' => $validator->errors()
            ],422);
        }
        $random = random_int(100000, 999999);

        $details = [
          'email' => $request->email,
          'code' => $random,
          'name' => \auth()->user()->name
        ];
        Mail::to($request->email)->send(new NewEmail($details));
        User::where('id', \auth()->user()->id)->update([
            'email_condidate' => $request->email,
            'email_conditate_code' => $random
        ]);

        return response()->json([
           'status' => true,
           'message' => 'code sended your email'
        ],200);
    }


    /**
     * @OA\Post(
     * path="/api/validation_email_condidate_code",
     * summary="validation_email_condidate_code",
     * description="validation_email_condidate_code",
     * operationId="validation_email_condidate_code",
     * tags={"MyCabinet"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user register",
     *    @OA\JsonContent(
     *       @OA\Property(property="code", type="string", format="text", example="code"),
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

    public function validation_email_condidate_code(Request $request){
        $rules=array(
            'code'  =>"required|max:6|min:6"
        );
        $messages = [
            'code.required' => 'Обязательное поле',
            'code.min' => 'Поле Должно сосстоять из 6-и символов',
            'code.max' => 'Поле Должно сосстоять из 6-и  символов',
        ];

        $validator=Validator::make($request->all(),$rules,$messages);
        if($validator->fails())
        {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ],422);
        }


        if (auth()->user()->email_conditate_code != $request->code){
            return response()->json([
               'status' => false,
                'message' => 'Wrong Code'
            ],422);
        }else{
             auth()->user()->update([
                'email' => auth()->user()->email_condidate,
                'email_condidate' =>null,
                'email_conditate_code' => null,
                'email_verify' => 1
            ]);

            return response()->json([
               'status' => true,
               'message' => 'Email Updated'
            ],200);
        }
    }




    /**
     * @OA\Post(
     * path="/api/update_user_name",
     * summary="update_user_name",
     * description="update_user_name",
     * operationId="update_user_name",
     * tags={"MyCabinet"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user register",
     *    @OA\JsonContent(
     *       @OA\Property(property="name", type="string", format="text", example="name   "),
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

    public function update_user_name(Request $request){
        $rules=array(
            'name'  =>"required"
        );
        $messages = [
            'name.required' => 'Обезателное поле',
        ];

        $validator=Validator::make($request->all(),$rules,$messages);
        if($validator->fails())
        {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ],422);
        }


        \auth()->user()->update([
            'name' => $request->name
        ]);

        return response()->json([
           'status' => true,
           'message' => 'Updated Name'
        ],200);

    }




}
