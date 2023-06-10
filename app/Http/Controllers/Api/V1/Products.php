<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;


class Products extends Controller
{


    /**
     * @OA\Get(
     * path="/api/all_products",
     * summary="all_products",
     * description="all_products",
     * operationId="all_products",
     * tags={"Products"},
     * @OA\RequestBody(
     *    required=true,
     *    description="all_products",
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
    public function all_products(){
        $user = auth()->guard('api')->user();

        if($user == null){
            $get =  Product::with('user','photo','category','made_in','taste')->where('status', 1)->inRandomOrder()->orderBY('id', 'desc')->simplepaginate(12);
        }else{
            $get =  Product::with('user','photo','category','made_in','taste','AuthUserFavorite')->where('status', 1)->inRandomOrder()->orderBY('id', 'desc')->simplepaginate(12);
        }



        return response()->json([
          'status'  => true,
           'data' => $get
       ],200);
    }

    /**
     * @OA\Get(
     * path="/api/single_page_product/product_id=5",
     * summary="single_page_product",
     * description="single_page_product",
     * operationId="single_page_product",
     * tags={"Products"},
     * @OA\RequestBody(
     *    required=true,
     *    description="single_page_product",
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

    public function single_page_product($id){
        $user = auth()->guard('api')->user();
        if ($user == null){

            $get = Product::where('id', $id)->with('user','photo','category','made_in','taste')->first();
        }else{

              $get = Product::where('id', $id)->with('user','photo','category','made_in','taste','AuthUserFavorite')->first();
        }

        if($get == null){
            return response()->json([
               'status' => false,
               'message' => 'wrong id'
            ],422);
        }

        if ($user == null){
            $isRandom = Product::where('category_id', $get->category_id)->where('status',1)->orwhere('made_in_id', $get->made_in_id)->where('status',1)->orwhere('taste_id', $get->taste_id)->where('status',1)->orwhere('user_id', $get->user_id)->where('status',1)
                ->with('user','photo','category','made_in','taste')->where('status',1)->inRandomOrder()->orderBY('id', 'desc')->limit(4)->get();

        }else{
            $isRandom = Product::where('category_id', $get->category_id)->where('status',1)->orwhere('made_in_id', $get->made_in_id)->where('status',1)->orwhere('taste_id', $get->taste_id)->where('status',1)->orwhere('user_id', $get->user_id)->where('status',1)
                ->with('user','photo','category','made_in','taste','AuthUserFavorite')->inRandomOrder()->orderBY('id', 'desc')->limit(4)->get();

        }


        return response()->json([
           'status' => true,
           'data' =>   $get,
            'is_random_data'  =>$isRandom
        ],200);

    }
}
