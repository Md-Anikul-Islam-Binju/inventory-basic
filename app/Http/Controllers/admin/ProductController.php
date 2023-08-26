<?php

namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Manufacture;
use App\Models\Product;
use App\Models\PurchaseVendor;
use App\Models\SaleProduct;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductSellExport;

class ProductController extends Controller
{
    public function show()
    {
        $category = Category::latest()->get();
        $purchase = PurchaseVendor::latest()->get();
        $manufacture = Manufacture::latest()->get();
        $product = Product::with('category','manufacture','purchaseVendor')->latest()->get();
        return view('admin.product.index',compact('product','category','purchase','manufacture'));
    }

    public function store(Request $request)
    {
       // dd($request->all());
        $request->validate([
            'product_code' => 'required|unique:products',
            'category_id' => 'required',
            'type' => 'required',
            'size' => 'required',
            'model_no' => 'required',
            'manufacturer_id' => 'required',
            'purchase_quantity' => 'required',
            'purchase_supplier_id' => 'required',
            'unit_price' => 'required',
            'status' => 'required',
        ]);
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/products'), $imageName);
            $product_image = 'images/products/' . $imageName;
        }else{
            $product_image = null;
        }
        $product = Product::create([
            'product_code' => $request->product_code,
            'category_id' => $request->category_id,
            'type' => $request->type,
            'size' => $request->size,
            'model_no' => $request->model_no,
            'manufacturer_id' => $request->manufacturer_id,
            'purchase_quantity' => $request->purchase_quantity,
            'purchase_supplier_id' => $request->purchase_supplier_id,
            'unit_price' => $request->unit_price,
            'purchase_quantity_to_after_sell' => $request->purchase_quantity,
            'product_image' => $product_image,
            'status' => $request->status,
        ]);
        return redirect()->back()->with('success','Product Added Successfully');
    }


    //product-update
    public function update(Request $request ,$id)
    {

        $product = Product::find($id);
        $product->update([
            'product_code' => $request->product_code,
            'category_id' => $request->category_id,
            'type' => $request->type,
            'size' => $request->size,
            'model_no' => $request->model_no,
            'manufacturer_id' => $request->manufacturer_id,
            'purchase_quantity' => $request->purchase_quantity,
            'purchase_supplier_id' => $request->purchase_supplier_id,
            'unit_price' => $request->unit_price,
            'purchase_quantity_to_after_sell' => $request->purchase_quantity,
            'sell_quantity' => $request->sell_quantity,
            'status' => $request->status,
        ]);
        return redirect()->back()->with('success','Product Updated Successfully');
    }

    //product destroy if had image destroy with image and if had no image then destroy without image
    public function destroy($id)
    {
        $product = Product::find($id);
        if($product->product_image){
            unlink($product->product_image);
            $product->delete();
        }else{
            $product->delete();
        }
        return redirect()->back()->with('success','Product Deleted Successfully');
    }

    public function sellProductHistory(Request $request)
    {
        $query = SaleProduct::with('product', 'customer')->latest();
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('created_at', [$request->input('start_date'), $request->input('end_date')]);
        }
        $productSell = $query->get();
        return view('admin.product.sellHistory', compact('productSell'));
    }

    //product invoice
    public function productInvoice($id)
    {
        $invoice = SaleProduct::with('product','customer')->find($id);
        return view('admin.invoice.invoice',compact('invoice'));
    }


    public function exportProductSellHistory()
    {
        return Excel::download(new ProductSellExport, 'users.xlsx');
    }

}
