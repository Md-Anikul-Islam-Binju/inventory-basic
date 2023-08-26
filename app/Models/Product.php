<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_code',
        'category_id',
        'type',
        'size',
        'model_no',
        'manufacturer_id',
        'purchase_quantity',
        'purchase_supplier_id',
        'unit_price',
        'purchase_quantity_to_after_sell',
        'product_image',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function purchaseVendor()
    {
        return $this->belongsTo(PurchaseVendor::class, 'purchase_supplier_id');
    }

    public function manufacture()
    {
        return $this->belongsTo(Manufacture::class, 'manufacturer_id');
    }
}

