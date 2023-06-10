<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FavoriteProduct;

class FavoriteProductController extends Controller
{


    /**
     * @OA\Post(
     * path="/api/add_or_delete_in_favorite",
     * summary="add_or_delete_in_favorite",
     * description="add_or_delete_in_favorite",
     * operationId="add_or_delete_in_favorite",
     * tags={"Favorite"},
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
     *    description="deleted is Favorite",
     *    @OA\JsonContent(
     *        )
     *     ),
     * @OA\Response(
     *    response=201,
     *    description="Created Is Favorite",
     *    @OA\JsonContent(
     *        )
     *     )
     * )
     */

    public function add_or_delete_in_favorite(Request  $request){
    $get = FavoriteProduct::where('user_id', auth()->user()->id)->where('product_id', $request->product_id)->first();
    if ($get == null){
        FavoriteProduct::create([
           'product_id' => $request->product_id,
           'user_id' => auth()->user()->id,
        ]);

    return response()->json([
       'status' => true,
       'message' => 'Created Is Favorite',
        'product_id' => $request->product_id
    ],200);
    }else{
        $get ->delete();

        return response()->json([
           'status' => true,
           'message' => 'deleted is Favorite',
            'product_id' => $request->product_id
        ],201);
    }
    }


    /**
     * @OA\Get(
     * path="/api/get_my_favorite",
     * summary="get_my_favorite",
     * description="get_my_favorite",
     * operationId="get_my_favorite",
     * tags={"Favorite"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user register",
     *    @OA\JsonContent(
     *
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="deleted is Favorite",
     *    @OA\JsonContent(
     *        )
     *     ),
     * @OA\Response(
     *    response=201,
     *    description="Created Is Favorite",
     *    @OA\JsonContent(
     *        )
     *     )
     * )
     */

    public function get_my_favorite(){
        $get = FavoriteProduct::where('user_id', auth()->user()->id)->with('product','product.photo')->get();

        return response()->json([
           'status' => true,
           'data' =>  $get
        ],200);
    }
}
