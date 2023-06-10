<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Validator;
use App\Models\ShopingBasket;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Mail\NewOrderFromModerator;

class OrderController extends Controller
{
    /**
     * @OA\Post(
     * path="/api/add_new_order",
     * summary="add_new_order",
     * description="add_new_order",
     * operationId="add_new_order",
     * tags={"Orders"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user register",
     *    @OA\JsonContent(
     *       @OA\Property(property="name", type="string", format="text", example="name"),
     *       @OA\Property(property="email", type="string", format="text", example="email"),
     *       @OA\Property(property="phone", type="string", format="text", example="phone"),
     *       @OA\Property(property="order_type", type="string", format="text", example="         Shops        Or  Drugoi      "),
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

    public function add_new_order(Request $request){



        $rules=array(
            'name'  =>"required",
            'email'  =>"required|email",
            'phone'  =>"required",
            'order_type'  =>"required",
        );
        $messages = [
            'email.required' => 'Обязательное поле',
            'name.required' => 'Обязательное поле',
            'phone.required' => 'Обязательное поле',
            'order_type.required' => 'Обязательное поле',
            'email.email' => 'Неверный формат Эл Почты',
        ];

        $validator=Validator::make($request->all(),$rules,$messages);
        if($validator->fails())
        {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ],422);
        }

        $time = time();



        $get_basket = ShopingBasket::where('user_id', auth()->user()->id)->get();

        if ($get_basket->isEMpty()){
            return response()->json([
               'status' => false,
               'message' => 'Ваша карзина пустая'
            ],422);
        }



      $order =   Order::create([
           'order_id' => $time,
           'user_id'  => auth()->user()->id,
           'name' => $request->name,
           'email' => $request->email,
           'phone' => $request->phone,
           'promo_code' => $request->promo_code,
           'comment' => $request->comment,
           'order_type' =>  $request->order_type,
           'status' => 1,
             'user_bonus' => auth()->user()->bonus
        ]);



        foreach ($get_basket as $basket ){
            OrderProduct::create([
               'order_id' => $order->id,
               'product_id' => $basket->product_id,
               'user_id' => auth()->user()->id,
               'shop_id' =>$basket->shop_id,
               'count' =>$basket->count,
            ]);
            $firstProduct = Product::where('id',  $basket->product_id)->first();
            $firstProduct->update([
               'count' =>  $firstProduct->count - $basket->count
            ]);
        }

            $get_user = User::where('role_id', 1)->first();



        $details = [
            'order_id' => $time,
            'url' => route('single_delivery',$order->id),
            'phone'=> $request->phone,
            'email' => $request->email,
            'name' => $request->name,
            'promo_code' => $request->promo_code
        ];

        Mail::to($get_user->email)->send(new NewOrderFromModerator($details));

        ShopingBasket::where('user_id', auth()->user()->id)->delete();
        return response()->json([
           'status' => true,
           'message' => "ЗАКАЗ No $time СФОРМИРОВАН"
        ],200 );

    }


    /**
     * @OA\Get(
     * path="/api/my_orders_history",
     * summary="my_orders_history",
     * description="my_orders_history",
     * operationId="my_orders_history",
     * tags={"Orders"},
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
    public  function my_orders_history(){
       $get =   Order::Orderby('id','desc')->where('user_id', auth()->user()->id)->with('OrderProduct','OrderProduct.Shop','OrderProduct.product.photo')->withsum('OrderProduct','count')->get();



        foreach ($get as $order) {
            foreach ($order->OrderProduct as $product) {
              $one_product_all_price =   $product->count * $product->product->price;
              if ($order->user_bonus > 0){
                  $order['all_price'] = $one_product_all_price - explode('.', $one_product_all_price * $order->user_bonus / 100)[0];
              }else{
                  $order['all_price'] = $one_product_all_price;
              }
            }
        }

       return response()->json([
          'status' => true,
          'message' => $get
       ],200);
    }


}
