<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LawsuitePaper extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'date' => 'date'
    ];

    public function lawsuite()
    {
        return $this->belongsTo(Lawsuite::class);
    }
}
