<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function clientAccount()
    {
        return $this->hasOne(ClientAccount::class);
    }

    public function lawsuite()
    {
        return $this->belongsTo(Lawsuite::class);
    }

    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }

    protected $appends = ['vatValue'];

    public function getVatValueAttribute()
    {
        return ($this->debit / 100) * $this->lawsuite->vat;
    }

}
