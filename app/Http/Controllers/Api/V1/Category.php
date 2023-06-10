<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\category as cat;
use App\Models\SubCategory;
use App\Models\taste;


class Category extends Controller
{

    /**
     * @OA\Get(
     * path="/api/get_shops",
     * summary="get_shops",
     * description="get_shops",
     * operationId="get_shops",
     * tags={"Category"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Auth Token Required",
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

    public function get_shops(){
        $get = User::where('role_id',2 )->get(['name', 'id', 'address']);


        return response()->json([
           'status' => true,
           'data' =>  $get
        ],200);
    }

    /**
     * @OA\Get(
     * path="/api/get_category",
     * summary="get_category",
     * description="get_category",
     * operationId="get_category",
     * tags={"Category"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Auth Token Required",
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

    public function get_category(){
        $get = cat::orderBy('id', 'desc')->get();

        return response()->json([
           'status' => true,
           'data' => $get
        ]);
    }

    /**
     * @OA\Get(
     * path="/api/get_all_made_in",
     * summary="get_all_made_in",
     * description="get_all_made_in",
     * operationId="get_all_made_in",
     * tags={"Category"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Auth Token Required",
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

    public function get_all_made_in(){
        $get = SubCategory::OrderBY('id', 'desc')->get();

        return response()->json([
           'status' => true,
           'data' => $get
        ],200);
    }

    /**
     * @OA\Get(
     * path="/api/get_all_taste",
     * summary="get_all_taste",
     * description="get_all_taste",
     * operationId="get_all_taste",
     * tags={"Category"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Auth Token Required",
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
    public function get_all_taste(){
        $get = taste::orderBy('id','desc')->get();

        return response()->json([
            'status' => true,
            'data' => $get
        ],200);
    }


}
