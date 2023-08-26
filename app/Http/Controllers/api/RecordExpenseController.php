<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\RecordExpense;
use Illuminate\Http\Request;

class RecordExpenseController extends Controller
{
   //record expense store
    public function store(Request $request)
   {
       $request->validate([
           'category_id' => 'required',
           'amount' => 'required',
           'date' => 'required',
       ]);
       $expense = new RecordExpense();
       $expense->category_id = $request->category_id;
       $expense->details = $request->details;
       $expense->amount = $request->amount;
       $expense->date = $request->date;
       $expense->save();
       return response()->json([
           'message' => 'Expense record successfully',
           'expense' => $expense
       ]);
   }

   //expense record show
    public function show()
    {
        try{
            $expense = RecordExpense::latest()->get();
            return response()->json([
                'message' => 'Expense record successfully',
                'expense' => $expense
            ]);
        }catch (\Exception $e){
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ]);
        }
    }
}
