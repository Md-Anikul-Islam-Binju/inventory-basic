<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\Product;
use App\Models\PurchaseVendor;
use App\Models\SaleProduct;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{

    public function home()
    {
        return view('dashboard');
    }

    public function dashboard()
    {
        if(auth()->user()->role == 1)
        {
            $product = Product::count();
            $sell = SaleProduct::count();
            $supplier = PurchaseVendor::count();
            $customer = Customer::count();
            return view('admin.dashboard',compact('product','sell','supplier','customer'));
        }
    }

    public function user()
    {
        $user = User::where('role',2)->latest()->get();
        return view('admin.user.index',compact('user'));
    }

    public function userStore(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'password' => 'required',
            ]);
            $user = new User();
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->phone = $validatedData['phone'];
            $user->password = bcrypt($validatedData['password']);
            $user->role = 2;
            $user->save();
            return redirect()->route('user')->with('success', 'User created successfully');
        } catch (\Exception $e) {
            return view('error', ['message' => 'Error storing user: ' . $e->getMessage()]);
        }
    }

    public function userUpdate(Request $request,$id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
            ]);
            $user = User::find($id);
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->phone = $validatedData['phone'];
            $user->save();
            return redirect()->route('user')->with('success', 'User updated successfully');
        } catch (\Exception $e) {
            return view('error', ['message' => 'Error updating user: ' . $e->getMessage()]);
        }
    }


    public function userDelete($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->route('user')->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('user')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }



}
