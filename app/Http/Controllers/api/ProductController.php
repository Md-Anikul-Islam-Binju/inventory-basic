<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Product;
use App\Models\SaleProduct;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //add product api
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'product_code' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'type' => 'required|string|max:255',
            'size' => 'required|string|max:255',
            'model_no' => 'required|string|max:255',
            'manufacturer_id' => 'required',
            'purchase_quantity' => 'required|integer',
            'purchase_supplier_id' => 'required',
            'product_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional image file, if included.
        ]);
        try {
            $product = new Product();
            $product->product_code = $validatedData['product_code'];
            $product->category_id = $validatedData['category_id'];
            $product->type = $validatedData['type'];
            $product->size = $validatedData['size'];
            $product->model_no = $validatedData['model_no'];
            $product->manufacturer_id = $validatedData['manufacturer_id'];
            $product->purchase_quantity = $validatedData['purchase_quantity'];
            $product->purchase_supplier_id = $validatedData['purchase_supplier_id'];

            if ($request->hasFile('product_image')) {
                $image = $request->file('product_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/products'), $imageName);
                $product->product_image = 'images/products/' . $imageName;
            }
            $product->purchase_quantity_to_after_sell = $validatedData['purchase_quantity'];
            $product->save();
            return response()->json(['message' => 'Product created successfully.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Unable to create product.', 'error' => $e->getMessage()], 500);
        }
    }

    //show product api with category
    public function show(){
        try {
            $products = Product::with('category')->where('status',1)->where('purchase_quantity_to_after_sell','>',0)->get();
            return response()->json(['message' => 'Product fetched successfully.', 'data' => $products]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Unable to fetch product.', 'error' => $e->getMessage()], 500);
        }
    }

//sell product
//    public function sellProduct(Request $request, $productId)
//    {
//        $sellQty = $request->input('sell_qty');
//        $product = Product::findOrFail($productId);
//        $availableQuantity = $product->purchase_quantity_to_after_sell;
//        $errors = [];
//        if ($availableQuantity <= 0) {
//            $errors['sell_qty'] = 'Product out of stock.';
//        }
//        if ($sellQty > $availableQuantity) {
//            $errors['sell_qty'] = 'Requested quantity exceeds available stock. Available quantity: ' . $availableQuantity . '. Please select a lower quantity.';
//        }
//        if ($sellQty <= 0) {
//            $errors['sell_qty'] = 'Invalid sell quantity. Please select a quantity greater than zero.';
//        }
//        // Validate the customer name
//        $customerName = $request->input('customer_name');
//        if (empty($customerName)) {
//            $errors['customer_name'] = 'Customer name is required.';
//        }
//        // You can add additional validation rules for customer name, such as minimum length, maximum length, or character restrictions if needed.
//        if (!empty($errors)) {
//            return response()->json(['errors' => $errors]);
//        }
//        $customerAddress = $request->input('customer_address');
//        $phone = $request->input('phone');
//        // Sell the product and update sales transaction table
//        SaleProduct::create([
//            'customer_name' => $customerName,
//            'customer_address' => $customerAddress,
//            'phone' => $phone,
//            'product_id' => $productId,
//            'sell_qty' => $sellQty,
//            'invoice_no' => 'INV-' . time() . '-' . $productId,
//        ]);
//        // Update the product table with the new available quantity
//        $product->purchase_quantity_to_after_sell -= $sellQty;
//        $product->save();
//        return response()->json(['message' => 'Product sold successfully.']);
//    }

    public function sellProduct(Request $request, $productId)
    {
        $sellQty = $request->input('sell_qty');
        $product = Product::findOrFail($productId);
        $availableQuantity = $product->purchase_quantity_to_after_sell;
        $errors = [];
        if ($availableQuantity <= 0) {
            $errors['sell_qty'] = 'Product out of stock.';
        }
        if ($sellQty > $availableQuantity) {
            $errors['sell_qty'] = 'Requested quantity exceeds available stock. Available quantity: ' . $availableQuantity . '. Please select a lower quantity.';
        }
        if ($sellQty <= 0) {
            $errors['sell_qty'] = 'Invalid sell quantity. Please select a quantity greater than zero.';
        }
        // Validate the customer name
        $customerName = $request->input('name');
        if (empty($customerName)) {
            $errors['customer_name'] = 'Customer name is required.';
        }
        // You can add additional validation rules for customer name, such as minimum length, maximum length, or character restrictions if needed.
        if (!empty($errors)) {
            return response()->json(['errors' => $errors]);
        }
        $customer = Customer::create([
            'name' => $customerName,
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
        ]);
        // Sell the product and update sales transaction table
        SaleProduct::create([
            'customer_id' => $customer->id,
            'product_id' => $productId,
            'sell_qty' => $sellQty,
            'invoice_no' => 'INV-' . time() . '-' . $productId,
        ]);
        //Update the product table with the new available quantity
        $product->purchase_quantity_to_after_sell -= $sellQty;
        $product->save();
        return response()->json(['message' => 'Product sold successfully.']);
    }

}
