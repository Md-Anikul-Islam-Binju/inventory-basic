<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\PurchaseVendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PurchaseVendorController extends Controller
{
    public function index()
    {
        $purchase = PurchaseVendor::latest()->get();
        return view('admin.product.purchaseVendoor',compact('purchase'));
    }
    public function store(Request $request)
    {

        try {
            // Validate the request data
            $validatedData = $request->validate([
                'vendor_name' => 'required',
                'vendor_email' => 'required',
                'vendor_phone' => 'required',
                'vendor_address' => 'required',
            ]);

            // Create a new category instance
            $purchase = new PurchaseVendor();
            $purchase->vendor_name = $validatedData['vendor_name'];
            $purchase->vendor_email = $validatedData['vendor_email'];
            $purchase->vendor_phone = $validatedData['vendor_phone'];
            $purchase->vendor_address = $validatedData['vendor_address'];
            // Save the purchase
            $purchase->save();
            // Pass the purchase to the view
            return redirect()->route('purchase')->with('success', 'purchase created successfully');
        } catch (\Exception $e) {
            // Handle the exception
            return view('error', ['message' => 'Error storing purchase: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'vendor_name' => 'required',
                'vendor_email' => 'required',
                'vendor_phone' => 'required',
                'vendor_address' => 'required',
                'status' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $purchase = PurchaseVendor::findOrFail($id);
            $purchase->vendor_name = $request->input('vendor_name');
            $purchase->vendor_email = $request->input('vendor_email');
            $purchase->vendor_phone = $request->input('vendor_phone');
            $purchase->vendor_address = $request->input('vendor_address');
            $purchase->status = $request->input('status');
            $purchase->save();

            return redirect()->route('purchase')->with('success', 'purchase updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $purchase = PurchaseVendor::findOrFail($id);
            $purchase->delete();

            return redirect()->route('purchase')->with('success', 'purchase deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('purchase')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

}
