<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Manufacture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ManufactureController extends Controller
{
    public function index()
    {
        $manufacture = Manufacture::latest()->get();
        return view('admin.product.menufacture',compact('manufacture'));
    }
    public function store(Request $request)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'manufacture_name' => 'required|string|max:255|unique:manufactures'
            ]);
            // Create a new menufacture instance
            $manufacture = new Manufacture();
            $manufacture->manufacture_name = $validatedData['manufacture_name'];

            // Save the menufacture
            $manufacture->save();

            // Pass the menufacture to the view
            return redirect()->route('manufacture')->with('success', 'Manufacture created successfully');
        } catch (\Exception $e) {
            // Handle the exception
            return view('error', ['message' => 'Error storing manufacture: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'manufacture_name' => 'required',
                'status' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $manufacture = Manufacture::findOrFail($id);
            $manufacture->manufacture_name = $request->input('manufacture_name');
            $manufacture->status = $request->input('status');
            $manufacture->save();

            return redirect()->route('manufacture')->with('success', 'Manufacture updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $manufacture = Manufacture::findOrFail($id);
            $manufacture->delete();

            return redirect()->route('manufacture')->with('success', 'Manufacture deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('manufacture')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
