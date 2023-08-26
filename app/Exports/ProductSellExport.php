<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\SaleProduct;


class ProductSellExport implements FromCollection
{
    public function collection()
    {
        return SaleProduct::all();
    }
}
