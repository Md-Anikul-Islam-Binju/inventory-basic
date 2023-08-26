<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseVendor extends Model
{
    use HasFactory;
    protected $fillable = [
        'vendor_name',
        'vendor_email',
        'vendor_phone',
        'vendor_address',
        'status',

    ];
}
