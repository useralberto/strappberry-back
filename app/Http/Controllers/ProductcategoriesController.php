<?php

namespace App\Http\Controllers;

use App\Models\Productcategories;
use Illuminate\Http\Request;

class ProductcategoriesController extends Controller
{
    public function index()
    {
        //$Categories = Productcategories::all();
        //return response()->json($Categories);
        $categories = Productcategories::select(
            'productcategories.id',
            'productcategories.name',
            'productcategories.slug'
        )->get();
        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(productcategories $productcategories)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, productcategories $productcategories)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(productcategories $productcategories)
    {
    }
}
