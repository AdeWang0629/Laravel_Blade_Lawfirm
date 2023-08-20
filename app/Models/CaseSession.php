<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseSession extends Model
{
    use HasFactory;

    protected $casts = [
        'start' => 'date'
    ];

    protected $guarded = [];

    public function court()
    {
        return $this->belongsTo(Court::class)->withTrashed();
    }

    public function lawsuite()
    {
        return $this->belongsTo(Lawsuite::class);
    }
}
