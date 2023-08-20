<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lawsuite extends Model
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

    public function clientType()
    {
        return $this->belongsTo(ClientType::class)->withTrashed();
    }

    public function caseType()
    {
        return $this->belongsTo(CaseType::class)->withTrashed();
    }

    public function caseStage()
    {
        return $this->belongsTo(CaseStage::class)->withTrashed();
    }

    public function lawsuitCase()
    {
        return $this->belongsTo(LawsuitCase::class)->withTrashed();
    }

    public function court()
    {
        return $this->belongsTo(Court::class)->withTrashed();
    }

    public function opponents()
    {
        return $this->hasMany(Opponent::class);
    }

    public function caseSessions()
    {
        return $this->hasMany(CaseSession::class);
    }

    public function clientAccounts()
    {
        return $this->hasMany(ClientAccount::class);
    }

    public function lawsuitNumbers()
    {
        return $this->hasMany(LawsuiteNumber::class);
    }

    public function receipts()
    {
        return $this->hasMany(Receipt::class);
    }

    public function lawsuitPapers()
    {
        return $this->hasMany(LawsuitePaper::class);
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    protected $appends = ['vatValue', 'lawsuiteRemaining'];

    public function getVatValueAttribute()
    {
        return ($this->vat / 100) * $this->contract_amount;
    }

    public function getLawsuiteRemainingAttribute()
    {
        return $this->total_amount -  $this->clientAccounts->sum('credit');
    }
}
