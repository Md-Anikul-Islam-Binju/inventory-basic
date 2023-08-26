<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.category.index',compact('categories'));
    }
    public function store(Request $request)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'name' => 'required|string|max:255|unique:categories'
            ]);

            // Create a new category instance
            $category = new Category();
            $category->name = $validatedData['name'];

            // Save the category
            $category->save();

            // Pass the category to the view
            return redirect()->route('category')->with('success', 'Category created successfully');
        } catch (\Exception $e) {
            // Handle the exception
            return view('error', ['message' => 'Error storing category: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'status' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            dd($request->all());
            $category = Category::findOrFail($id);
            $category->name = $request->input('name');
            $category->status = $request->input('status');
            $category->save();

            return redirect()->route('category')->with('success', 'Category updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();

            return redirect()->route('category')->with('success', 'Category deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('category')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
