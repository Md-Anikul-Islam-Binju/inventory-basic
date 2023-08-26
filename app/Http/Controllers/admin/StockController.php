<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\SaleProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class StockController extends Controller
{
    public function index()
    {
        $products = Product::where('purchase_quantity_to_after_sell','>',0)->get();
        return view('admin.stock.stock',compact('products'));
    }


    //update stock
    public function updateStock(Request $request)
    {
        $id = $request->input('id');
        $purchaseQuantityToAdd = intval($request->input('purchase_quantity_to_after_sell'));
        // Find the product based on the product ID
        $product = Product::find($id);
        if ($product) {
            // Update purchase_quantity and purchase_quantity_to_after_sell columns
            $product->purchase_quantity += $purchaseQuantityToAdd;
            $product->purchase_quantity_to_after_sell += $purchaseQuantityToAdd;
            $product->save();
            return redirect()->route('stock')->with('success', 'Stock updated successfully');
        } else {
            return redirect()->route('stock')->with('success', 'Stock updated successfully');
        }
    }

    public function sell(Request $request,$id)
    {
        $product = Product::findOrFail($id);
        return view('admin.stock.sellProduct',compact('product'));
    }

    public function add(Request $request)
    {

        $product = Product::find($request->product_id);
        $sellQty = $request->sell_qty; // Get the selected quantity
        // Add the product and quantity to the cart session
        $cart = Session::get('cart', []);
        $cart[] = ['product' => $product, 'sell_qty' => $sellQty];
        Session::put('cart', $cart);

        return redirect()->route('cart.show');
    }

    public function show()
    {
        $cartItems = Session::get('cart', []);
        return view('admin.stock.cart', compact('cartItems'));
    }

    public function processCheckout(Request $request)
    {
        // Create customer record based on input
        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        // Process each cart item
        foreach (Session::get('cart', []) as $productData) {
            // Access the nested "id" key
            $productId = $productData['product']['id'];

            // Access the nested "sell_qty" key
            $sellQty = $productData['sell_qty'];

            // Create sale_product record
            SaleProduct::create([
                'customer_id' => $customer->id,
                'product_id' => $productId,
                'sell_qty' => $sellQty,
                'invoice_no' => 'INVOICE_' . uniqid(),
            ]);

            // Update the product's purchase_quantity_to_after_sell value
            $productModel = Product::findOrFail($productId);
            $newPurchaseQty = $productModel->purchase_quantity_to_after_sell - $sellQty;
            $productModel->update([
                'purchase_quantity_to_after_sell' => max(0, $newPurchaseQty),
            ]);
        }

        // Clear the cart
        Session::forget('cart');

        return redirect()->route('product.sellHistory')->with('success', 'Checkout successful!');
    }



}
