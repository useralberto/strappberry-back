<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Productcategories;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit = $request->query('limit', 20);
        $category = $request->query('category');
        $query = Product::select(
            'products.*',
            'productcategories.name as category'
        )
            ->join('productcategories', 'productcategories.id', '=', 'products.category_id');

        if ($category) {
            $query->where('productcategories.slug', $category);
        }

        $products = $query->paginate($limit);
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|min:1|max:100',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'quantity' => 'required|numeric',
            'image' => 'required|string',
            'category_id' => 'required|numeric'
        ];


        $validator = \Validator::make($request->input(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $product = new Product($request->input());
        $product->save();
        return response()->json([
            'status' => true,
            'message' => 'Product created successfully'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        return response()->json(['status' => true, 'data' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, product $product)
    {

        $rules = [
            'name' => 'required|string|min:1|max:100',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'quantity' => 'required|numeric',
            'category_id' => 'required|numeric'
        ];

        if ($request->hasFile('image')) {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $product->update($request->input());
        /*if ($request->hasFile('image')) {*/
        /*$base64Image = $request->input('image');*/
        /*$image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image));*/
        /*$imageName = time() . '.jpg';*/
        /*//$imagePath = $image->store('products');*/
        /*echo $image;*/
        /*//$product->image = $imagePath;*/
        /*//$product->save();*/
        /*}*/
        return response()->json([
            'status' => true,
            'message' => 'Producto actualizado exitosamente'
        ], 200);

        /*$rules = [*/
        /*'name' => 'required|string|min:1|max:100',*/
        /*'price' => 'required|numeric',*/
        /*'description' => 'required|string',*/
        /*'quantity' => 'required|numeric',*/
        /*'image' => 'required|string',*/
        /*'category_id' => 'required|numeric'*/
        /*];*/
        /*$validator = \Validator::make($request->input(), $rules);*/
        /*if ($validator->fails()) {*/
        /*return response()->json([*/
        /*'status' => false,*/
        /*'errors' => $validator->errors()->all()*/
        /*], 400);*/
        /*}*/
        /*$product->update($request->input());*/
        /*return response()->json([*/
        /*'status' => true,*/
        /*'message' => 'Product updated successfully'*/
        /*], 200);*/
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product)
    {
        $product->delete();
        return response()->json([
            'status' => true,
            'message' => 'Product deleted successfully'
        ], 200);
    }

    public function getProduct($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }
        return response()->json(['data' => $product], 200);
    }
}
