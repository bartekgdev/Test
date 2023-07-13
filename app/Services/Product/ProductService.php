<?php

namespace App\Services\Product;

use App\Product;
use App\Tag;
use App\Events\ProductCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductService
{
    public function new(Request $request)
    {
        // Validatie van nieuwe product
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products,name',
            'description' => 'required|string',
            'tags' => 'required|string',
        ], [
            'name.required' => 'The name field is required.',
            'name.unique' => 'The name field must be unique.',
            'description.required' => 'The description field is required.',
            'tags.required' => 'The tags field is required.',
        ]);

        // Error van validatie
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return redirect('/products')->with('error', $error)->withInput();
        }

        // Tags opsplisten met komma's en 
        $tagNames = explode(',', $request->tags);
        foreach ($tagNames as $tagName) {
            $tagName = trim($tagName);
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $product->tags()->attach($tag);
        }

        // Nieuwe product aanmaken met eloquent ORM
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->save();

        // Melding sturen
        event(new ProductCreated($product));

        return redirect('/products')->with('status', 'Product saved')->with('notification', 'New product created successfully');

    }

    public function delete(Request $request)
    {
        $product = Product::find($request->id);

        if ($product) {
            $product->delete();
            return redirect('/products')->with('status', 'Product was deleted');
        }

        return redirect('/products')->with('error', 'Product not found');
    }
}
