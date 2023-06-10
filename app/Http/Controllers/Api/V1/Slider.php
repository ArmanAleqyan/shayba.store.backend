<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider as sl;

class Slider extends Controller
{

    /**
     * @OA\Get(
     * path="/api/all_slider",
     * summary="all_slider",
     * description="all_slider",
     * operationId="all_slider",
     * tags={"Slider"},
     * @OA\RequestBody(
     *    required=true,
     *    description="all_slider",
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


    public function all_slider(){
       $get  = sl::where('status', 1)->orderbY('order_by', 'asc')->orderby('updated_at', 'desc')->get();

       return response()->json([
          'status' => true,
          'data' => $get
       ],200);
    }
}
