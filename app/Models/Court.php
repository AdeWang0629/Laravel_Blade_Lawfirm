<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Court extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function lawsuites()
    {
        return $this->hasMany(Lawsuite::class);
    }

    public function caseSessions()
    {
        return $this->hasMany(CaseSession::class);
    }
}
