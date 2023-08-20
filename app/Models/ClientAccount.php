<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientAccount extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function lawsuite()
    {
        return $this->belongsTo(Lawsuite::class);
    }

    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }

    public function receipt()
    {
        return $this->belongsTo(Receipt::class);
    }
}
