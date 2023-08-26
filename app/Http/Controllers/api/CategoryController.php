<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //category show api
    public function index()
    {
        try {
            $categories = Category::all(['id','name', 'status']);
            // Check if any categories are found, return 404 if none.
            if ($categories->isEmpty()) {
                return response()->json(['message' => 'No categories found.'], 404);
            }
            return response()->json($categories);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error retrieving categories.', 'error' => $e->getMessage()], 500);
        }
    }
}
