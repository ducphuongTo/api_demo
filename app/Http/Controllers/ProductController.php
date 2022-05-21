<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Validator;
class ProductController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function getProducts()
{
    $products = Products::all();
    return response()->json([
    "success" => true,
    "message" => "Product List",
    "data" => $products
    ]);
}
/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function addProduct(Request $request)
{
    $input = $request->all();
    $validator = FacadesValidator::make($input, [
    'product_name' => 'required',
    'product_thumbnail' => 'required',
    'product_image' => 'required',
    'product_price' => 'required',
    'brand_id' => 'required',
    'category_id' => 'required',
    'desc' => 'required'
    ]);
    if($validator->fails()){
    return $this->sendError('Validation Error.', $validator->errors());       
    }
    $product = Products::create($input);
    return response()->json([
    "success" => true,
    "message" => "Product created successfully.",
    "data" => $product
    ]);
} 
/**
* Display the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function getProductById($id)
{
    $product = Products::find($id);
    if(!empty($product))
    {
        return response()->json($product);
    }
    else
    {
        return response()->json([
            "message" => "Product not found"
        ], 404);
    }
}
/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function updateProduct(Request $request, $id)
    {
        if (Products::where('id', $id)->exists()) {
            $product = Products::find($id);
            $product->product_name = is_null($request->product_name) ? $product->product_name : $request->product_name;
            $product->product_price = is_null($request->product_price) ? $product->product_price : $request->product_price;
            $product->product_image = is_null($request->product_image) ? $product->product_image : $request->product_image;
            $product->product_thumbnail = is_null($request->product_thumbnail) ? $product->product_thumbnail : $request->product_thumbnail;
            $product->desc = is_null($request->desc) ? $product->desc : $request->desc;
            $product->brand_id = is_null($request->brand_id) ? $product->brand_id : $request->brand_id;
            $product->category_id = is_null($request->category_id) ? $product->category_id : $request->category_id;
            $product->save();
            return response()->json([
                "message" => "product Updated."
            ], 404);
        }else{
            return response()->json([
                "message" => "product Not Found."
            ], 404);
        }
    }
/**
* Remove the specified resource from storage.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function deleteProduct(Products $product,$id)
{
    if(Products::where('id', $id)->exists()) {
        $book = Products::find($id);
        $book->delete();

        return response()->json([
          "message" => "records deleted."
        ], 202);
    } else {
        return response()->json([
          "message" => "book not found."
        ], 404);
    }
}
}