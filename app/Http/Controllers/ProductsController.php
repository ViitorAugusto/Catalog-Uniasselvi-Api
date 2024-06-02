<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    public function productsList()
    {
        $products = Product::with('images')->get();
        return response()->json($products);
    }

    public function getProductById($id)
    {
        if (!$id) {
            return response()->json(["message" => "id nao fornecido"], 400);
        }
        $product = Product::with('images')->where('id', $id)->first();
        if (!$product) return response()->json(["message" => "produto nao existe"], 400);
        else return response()->json($product);
    }

    public function checkTitle(Request $request)
    {
        $title = $request->query('title');
        $exists = Product::where('title', $title)->exists();
        return response()->json(['exists' => $exists]);
    }

    public function createProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products',
            'price' => 'required|numeric',
            'images' => 'required|array|max:4',
            'images.*' => 'image|max:2048',
            'mainImage' => 'required|image|max:2048',
            'description' => 'required|string|max:500',
            'moreDetails' => 'required|string|max:5000',
            'category' => 'required|string|max:255',
            'featured' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Armazenar as imagens
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('images', 'public');
            }
        }

        // Armazenar a imagem principal
        $mainImagePath = $request->file('mainImage')->store('images', 'public');

        $product = Product::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'price' => $request->price,
            'image' => $mainImagePath, // Usando a imagem principal
            'description' => $request->description,
            'moreDetails' => $request->moreDetails,
            'category' => $request->category,
            'featured' => $request->featured ?? false,
        ]);

        // Armazenar as imagens adicionais
        foreach ($imagePaths as $path) {
            $product->images()->create(['path' => $path]);
        }

        return response()->json(['message' => 'Produto criado com sucesso!', 'produto' => $product]);
    }
}
