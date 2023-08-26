<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use App\Models\ExpenseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExpenseCategoryController extends Controller
{
    public function index()
    {
        $categories = ExpenseCategory::latest()->get();
        return view('admin.expense.category',compact('categories'));
    }
    public function store(Request $request)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'name' => 'required|string|max:255|unique:categories'
            ]);

            // Create a new category instance
            $category = new ExpenseCategory();
            $category->name = $validatedData['name'];

            // Save the category
            $category->save();

            // Pass the category to the view
            return redirect()->route('expense.category')->with('success', 'Expense Category created successfully');
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
            $category = ExpenseCategory::findOrFail($id);
            $category->name = $request->input('name');
            $category->status = $request->input('status');
            $category->save();

            return redirect()->route('expense.category')->with('success', 'Expense Category updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $category = ExpenseCategory::findOrFail($id);
            $category->delete();

            return redirect()->route('expense.category')->with('success', 'Expense Category deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('expense.category')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
