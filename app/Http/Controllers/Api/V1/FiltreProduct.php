<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\category;
use App\Models\taste;
use App\Models\taste_category;
use App\Models\MadeInCategoryId;
use App\Models\taste_made_in;

class FiltreProduct extends Controller
{


    /**
     * @OA\Post(
     * path="/api/filtered_product",
     * summary="filtered_product",
     * description="filtered_product",
     * operationId="filtered_product",
     * tags={"Products"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Ham Filttracian ham searcha anumes mi apaiov vor@ uzumes filtres uxxarkumes et key@ u staanumes tvyaln prroductner@ karas smiangamicc mi qani key uxarkes orinac category_id u taste_id  paginationi depqum petqa uxarkact tvyalner@ noric uxarkes u paage nshes  page neextt",
     *    @OA\JsonContent(
     *       @OA\Property(property="made_in_id", type="string", format="text", example="1"),
     *       @OA\Property(property="category_id", type="string", format="text", example="1"),
     *       @OA\Property(property="taste_id", type="string", format="text", example="1"),
     *       @OA\Property(property="orderbyPriceAsc", type="string", format="text", example="1"),
     *       @OA\Property(property="orderbyPriceDesc", type="string", format="text", example="1"),
     *       @OA\Property(property="search", type="string", format="text", example="search"),
     *       @OA\Property(property="max_price", type="string", format="text", example="100000"),
     *       @OA\Property(property="min_price", type="string", format="text", example="100000"),
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


    public function filtered_product(Request $request){
        $made_in = $request->made_in_id;
        $category_id = $request->category_id;
        $taste_id = $request->taste_id;
        $orderbyPriceAsc = $request->orderbyPriceAsc;
        $orderbyPriceDesc = $request->orderbyPriceDesc;
        $search = $request->search;

        $product = Product::query();
        $category  =  category::query();
        $made_in_data  =  SubCategory::query();
        $taste  =  taste::query();
        if (isset($category_id)){
            $product->where('category_id',$category_id);
            $filtr_made_in = MadeInCategoryId::where('category_id', $category_id)->get('made_in_id')->pluck('made_in_id')->toarray();
            $filter_category_taste = taste_category::where('category_id', $category_id)->get('taste_id')->pluck('taste_id')->toarray();
            $made_in_data->whereIn('id', $filtr_made_in);
            $taste->whereIn('id', $filter_category_taste);
        }
        if(isset($made_in)){
            $product->where('made_in_id',$made_in);
            $filter_category =  MadeInCategoryId::where('made_in_id', $made_in)->get('category_id')->pluck('category_id')->toarray();
             $taste_made_in  =    taste_made_in::where('made_in_id', $made_in)->get('taste_id')->pluck('taste_id')->toarray();
            $category->wherein('id',$filter_category);
            $taste->wherein('id',$taste_made_in);
        }
        if (isset($taste_id)){
            $product->where('taste_id',$taste_id);
            $taste_made_in    =  taste_made_in::where('taste_id', $taste_id)->get('made_in_id')->pluck('made_in_id')->toarray();
             $filter_category2  =    taste_category::where('taste_id', $taste_id)->get('category_id')->pluck('category_id')->toarray();
            $category->wherein('id',$filter_category2);
            $made_in_data->wherein('id',$taste_made_in);
        }

        if (isset($orderbyPriceAsc)){
            $product->orderbY('price', 'asc');
        }
        if (isset($orderbyPriceDesc)){
            $product->orderBY('price', 'desc');
        }

        if (isset($request->min_price)){
            $product->where('price', '>', $request->min_price);
        }

        if (isset($request->max_price)){
            $product->where('price', '<', $request->max_price);
        }

        if (isset($request->min_price) && isset($request->max_price)){
            $product->whereBetween('price', [$request->min_price , $request->max_price]);
        }




        if(isset($search)){
            $keyword =$search;
            $name_parts = explode(" ", $keyword);
            foreach ($name_parts as $part) {
                $product->orWhere(function ($query) use ($part) {
                    $query->where('name', 'like', "%{$part}%")
                    ->orwhere('art', 'like', "%{$part}%")
                    ->orwhere('strength', 'like', "%{$part}%")
                        ->orWhereHas('made_in', function ($query) use ($part) {
                            $query->where('name', 'like', "%{$part}%");
                        })
                        ->orWhereHas('taste', function ($query) use ($part) {
                            $query->where('name', 'like', "%{$part}%");
                        })
                        ->orWhereHas('category', function ($query) use ($part) {
                            $query->where('name', 'like', "%{$part}%");
                        });
                    ;
                });
            }
        }

        $user =  auth()->guard('api')->user();
        if($user == null){

            $get = $product->with('user','photo','category','made_in','taste')->where('status', 1)->simplePaginate(20);
        }else{
            $get = $product->with('user','photo','category','made_in','taste','AuthUserFavorite')->where('status', 1)->simplePaginate(20);
        }
        $category2 = $category->orderBY('name','asc')->get();
        $made_in2 = $made_in_data->get();
        $taste2 = $taste->get();
        
        return response()->json([
           'status' => true,
            'data' => $get,
            'category' => $category2,
            'made_in' => $made_in2,
            'taste' => $taste2,

        ]);




    }
}
