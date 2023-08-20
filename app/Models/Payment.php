<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function branch()
    {
        return $this->belongsTo(Branch::class)->withTrashed();
    }

    public function expenseSection()
    {
        return $this->belongsTo(ExpenseSection::class)->withTrashed();
    }
}
