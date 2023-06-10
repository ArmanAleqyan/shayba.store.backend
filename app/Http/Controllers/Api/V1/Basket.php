<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use App\Models\Product;
use App\Models\ShopingBasket;

class Basket extends Controller
{



    /**
     * @OA\Post(
     * path="/api/add_in_basket",
     * summary="add_in_basket",
     * description="add_in_basket",
     * operationId="add_in_basket",
     * tags={"Basket"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user register",
     *    @OA\JsonContent(
     *       @OA\Property(property="product_id", type="string", format="text", example="product_id"),
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

    public function add_in_basket(Request $request){



        $rules=array(
            'product_id'  =>"required",
        );
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return response()->json([
               'status' =>  false,
               'message' =>$validator->errors()

            ]);
        }


        $get_pproduct  = Product::where('id', $request->product_id)->first();
        if($get_pproduct  == null){
            return response()->json([
               'status' => false,
               'message' => 'wrong product_id'
            ],422);
        }

        $get_baskeet =  ShopingBasket::where('user_id',  auth()->user()->id)->where('product_id', $request->product_id)->first();

//        dd();



        if($get_baskeet  != null){
            if ($get_pproduct['count'] <= $get_baskeet->count  ){
                return response()->json([
                    'status' => false,
                    'message' => "У вас в корзине уже есть максимальное количество этого продукта"
                ],422);
            }
            $get_baskeet->update([
               'count' => $get_baskeet->count + 1
            ]);
        }else{
            ShopingBasket::create([
                'user_id' => auth()->user()->id,
                'product_id' => $request->product_id,
                'shop_id' => $get_pproduct->user_id
            ]);
        }


        $get_basket_count = ShopingBasket::where('user_id', auth()->user()->id)->where('product_id', $request->product_id)->first();

        return response()->json([
           'status' => true,
           'message'  => 'product added in basket',
            'count' => $get_basket_count
        ],200);

    }

    /**
     * @OA\Post(
     * path="/api/get_my_basket",
     * summary="get_my_basket",
     * description="get_my_basket",
     * operationId="get_my_basket",
     * tags={"Basket"},
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

    public function get_my_basket(){
       $getBasket =   ShopingBasket::where('user_id', auth()->user()->id)->get('product_id')->pluck('product_id')->toarray();
       $getProduct  = Product::with('user','photo','category','made_in','taste')->wherein('id',$getBasket)->withsum('basket','count')->get();
        $getBasketFromshops =   ShopingBasket::where('user_id', auth()->user()->id)->get('shop_id')->pluck('shop_id')->toarray();

        $getShops = User::whereIn('id', $getBasketFromshops)->with(['product.AuthUserFavorite','product' => function($query) use ($getBasket) {
                $query->wherein('id', $getBasket)->withsum('basket','count')->with('photo','category','made_in','taste');
        }])->get();

        foreach ($getShops as $getShop) {
          foreach ($getShop['product'] as $bask){
              if (auth() ->user()->bonus > 0){
                  $bask['bonus_price'] = $bask['price'] - explode('.', $bask['price'] * auth()->user()->bonus / 100)[0];
              }else{
                  $bask['bonus_price'] = null;
              }
              $get =  ShopingBasket::where('user_id', auth()->user()->id)->where('product_id', $bask['id'])->first();
              $bask['basket_count'] = $get['count'];
          }
        }

        if (auth()->user() == null){
            $getProduct2 = Product::with('user','photo','category','made_in','taste');
            $getRandom =  $getProduct2->with('user','photo','category','made_in','taste')->where('status', 1)->inRandomOrder()->limit(4)->get();
        }else{
            $getProduct2 = Product::with('user','photo','category','made_in','taste','AuthUserFavorite');
            $getRandom =  $getProduct2->with('user','photo','category','made_in','taste','AuthUserFavorite')->where('status', 1)->inRandomOrder()->limit(4)->get();
        }
       return response()->json([
          'status' => true,
          'data' =>  $getShops,
           'random_product' => $getRandom
       ],200);
    }


    /**
     * @OA\Post(
     * path="/api/delete_all_basket",
     * summary="delete_all_basket",
     * description="delete_all_basket",
     * operationId="delete_all_basket",
     * tags={"Basket"},
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
    public function delete_all_basket(){
        ShopingBasket::where('user_id', auth()->user()->id)->delete();

        return response()->json([
           'status' => true,
           'message' => 'Basket Deleted'
        ],200);
    }


    /**
     * @OA\Post(
     * path="/api/minus_basket_product",
     * summary="minus_basket_product",
     * description="minus_basket_product",
     * operationId="minus_basket_product",
     * tags={"Basket"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user register",
     *    @OA\JsonContent(
     *       @OA\Property(property="product_id", type="string", format="text", example="product_id"),
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

    public function minus_basket_product(Request $request){
        $rules=array(
            'product_id'  =>"required",
        );
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return response()->json([
                'status' =>  false,
                'message' =>$validator->errors()

            ]);
        }


        $get_pproduct  = Product::where('id', $request->product_id)->first();
        if($get_pproduct  == null){
            return response()->json([
                'status' => false,
                'message' => 'wrong product_id'
            ],422);
        }

        $get_baskeet =  ShopingBasket::where('user_id',  auth()->user()->id)->where('product_id', $request->product_id)->first();

        if($get_baskeet  != null){
            if($get_baskeet->count > 1){
                $get_baskeet->update([
                    'count' => $get_baskeet->count - 1
                ]);
            }else{
                $get_baskeet->delete();
            }
        }

        $get_basket_count = ShopingBasket::where('user_id', auth()->user()->id)->where('product_id', $request->product_id)->first();

        return response()->json([
            'status' => true,
            'message'  => 'product deleted in basket',
            'count' => $get_basket_count
        ],200);
    }

}
