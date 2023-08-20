<?php

namespace App\Models;

use App\Notifications\CustomResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Client extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function lawsuites()
    {
        return $this->hasMany(Lawsuite::class);
    }

    public function consultations()
    {
        return $this->hasMany(Consultation::class)->withTrashed();
    }

    public function clientAccounts()
    {
        return $this->hasMany(ClientAccount::class);
    }

    public function receipts()
    {
        return $this->hasMany(Receipt::class);
    }

    public function statusWithLabel()
    {
        switch ($this->status) {
            case 1: $result = '<label class="badge bg-success text-white">'.trans('site.active').'</label>'; break;
            case 0: $result = '<label class="badge bg-danger text-white">'.trans('site.in_active').'</label>'; break;
        }
        return $result;
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPassword($token));
    }
}
