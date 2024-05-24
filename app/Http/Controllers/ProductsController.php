<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    public function productsList(){
        $products = Product::all();
        return response()->json($products);
    }

    public function getProductById($id){
        if(!$id){
            return response()->json(["message"=> "id nao fornecido"],400);
        }
        $product = Product::where('id',$id)->first();
        if(!$product) return response()->json(["message"=> "produto nao existe"],400);
        else return response()->json($product);
    }

    public function store(Request $request){
        info($request);
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'required|file',
            'description' => 'required|string',
            'moreDetails' => 'required|string',
            'featured' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $image = $request->file('image');
        $images = $request->file('images');

        // Process single image
        $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);

        //Caso tenha apenas uma posicao em 'images', arrume para o código usar isso:
        $imgName = Str::uuid() . '.' . $images->getClientOriginalExtension();
        $images->move(public_path('images'), $imgName);

        //Caso tenha várias posições em 'images', arrume para o código usar isso:
        $imagesName = [];
        foreach ($images as $img) {
            $imgName = Str::uuid() . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('images'), $imgName);
            $imagesName[] = 'images/' . $imgName;
        }

        $product = Product::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'price' => $request->price,
            'image' => 'images/' . $imageName,
            'images' => 'images/' . $imgName,
            'description' => $request->description,
            'moreDetails' => $request->moreDetails,
            'featured' => $request->featured,
        ]);

        return response()->json(['message' => 'Produto criado com sucesso!', 'produto' => $product]);
    }
}
