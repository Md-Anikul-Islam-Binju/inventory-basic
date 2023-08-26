<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecordExpense extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'details',
        'amount',
        'date',
    ];

    public function category()
    {
        return $this->belongsTo(ExpenseCategory::class);
    }
}
