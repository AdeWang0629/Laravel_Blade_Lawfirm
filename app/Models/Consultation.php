<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'contract_date' => 'date'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class)->withTrashed();
    }

    public function clientAccounts()
    {
        return $this->hasMany(ClientAccount::class);
    }

    public function receipts()
    {
        return $this->hasMany(Receipt::class);
    }

    protected $appends = ['vatValue'];

    public function getVatValueAttribute()
    {
        return ($this->vat / 100) * $this->contract_amount;
    }

    public function getConsultationRemainingAttribute()
    {
        return $this->total_amount -  $this->clientAccounts->sum('credit');
    }
}
