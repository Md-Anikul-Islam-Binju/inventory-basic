<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\ExpenseCategory;
use App\Models\RecordExpense;
use Illuminate\Http\Request;

class RecordExpenseController extends Controller
{
    //expense record store
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'details' => 'required',
            'amount' => 'required',
            'date' => 'required',
        ]);

        RecordExpense::create([
            'category_id' => $request->category_id,
            'details' => $request->details,
            'amount' => $request->amount,
            'date' => $request->date,
        ]);

        return redirect()->back()->with('success', 'Expense Record Added Successfully');
    }

    //expense record update
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required',
            'details' => 'required',
            'amount' => 'required',
            'date' => 'required',
        ]);
        RecordExpense::find($id)->update([
            'category_id' => $request->category_id,
            'details' => $request->details,
            'amount' => $request->amount,
            'date' => $request->date,
        ]);
        return redirect()->back()->with('success', 'Expense Record Updated Successfully');
    }



    //expense record show
    public function show()
    {
        $category = ExpenseCategory::latest()->get();
        $expense = RecordExpense::with('category')->latest()->get();
        return view('admin.expense.index', compact('expense', 'category'));
    }

    //expense record delete
    public function destroy($id)
    {
        RecordExpense::find($id)->delete();
        return redirect()->back()->with('success', 'Expense Record Deleted Successfully');
    }

}
