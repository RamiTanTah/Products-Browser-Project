<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Comment;
use App\Models\DiscountOffer;
use App\Http\Request\ProductRequest;

use Carbon\Carbon;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

    	$response['data'] = $products;
        $response['message'] = "this is all Products";
        return response()->json($response,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)

    {
        $product = new Product;
        $product->name_ar = $request->name_ar;
        $product->name_en = $request->name_en;
        $product->description_ar = $request->description_ar;
        $product->description_en = $request->description_en;
        $product->quantity = $request->quantity;
        $product->image = $request->image;
        $product->price = $request->price;
        $product->price_after_discount = $request->price_after_discount;
        $product->production_date = $request->production_date;
        $product->expired_date = $request->expired_date;
        //$product->is_expired = $request->is_expired;
        $product->views = $request->views;
        $product->likes = $request->likes;

        $product->user_id = $request->user_id;
        $product->category_id = $request->category_id;



        // $date = Carbon::now();
        // $date1=Carbon::createFromFormat('Y-m-d', $product->expired_date);
        // $def_date = $date->diff($date1);
        // $days = $def_date->format('%a');
        // $price=$product->price;
        // if($days>=10){
        //     $percent=100-$product->price_after_discount;
            
        // }
        // $price=($product->price)*($percent/100);


        $product-> save();

        $response['data'] = $product;
        $response['message'] = "Product has been stored successfully";
        return response()->json($response,200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = product::where('id' , $id)->first();

        if (isset($product)) {
                $response['data'] = $product;
                $response['message'] = "this is product";
                return response()->json($response,200);
            }
                $response['data'] = $product;
                $response['message'] = "Error Not Found";
                return response()->json($response,404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        
     if (isset($product)) {
     	if (isset($request->name_ar)) {
     		$product->name_ar = $request->name_ar;
 

     	}
        if (isset($request->name_en)) {
            $product->name_en = $request->name_en;
        }
     	if (isset($request->description_ar)) {
     		$product->description_ar = $request->description_ar;
     	}
        if (isset($request->description_en)) {
            $product->description_en = $request->description_en;
        }
     	if (isset($request->quantity)) {
     		$product->quantity = $request->quantity;
     	}
     	if (isset($request->image)) {
     		$product->image = $request->image;
     	}
     	if (isset($request->price)) {
     		$product->price = $request->price;
     	}
     	if (isset($request->price_after_discount)) {
     		 $product->price_after_discount = $request->price_after_discount;
     	}
     	if (isset($request->production_date)) {
     		$product->production_date = $request->production_date;
     	}
     	if (isset($request->expired_date)) {
     		$product->expired_date = $request->expired_date;
     	}

        if (isset($request->views)) {
            $product->views = $request->views;
        }
     	if (isset($request->likes)) {
     		$product->likes = $request->likes;
     	}

         
	    $product->save();


        $response['data'] = $product;
        $response['message'] = "success";
        return response()->json($response,200);

     }
        $response['data'] = $product;
        $response['message'] = "Error Not Found";
        return response()->json($response,404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $product = product::find($id);
        if (isset($product)) {
            $product->delete();


            $response['data'] = '';
            $response['message'] = "Deleted success";
            return response()->json($response,200);

        }
            $response['data'] = '';
            $response['message'] = "Error Not Found";
            return response()->json($response,404);
    }


    public function searchByName($keyword)
    {

            $product=Product::where(function ($query) use ($keyword) {
                $query->where('name_en', 'LIKE', "%$keyword%");
            })->get();
        
        return $product;
    }

    public function searchByCategory($keyword)
    {

            $products=Product::where(function ($query) use ($keyword) {
                $query->where('name_en', 'LIKE', "%$keyword%");
            })->get();
        
        return $products;
    }
}
