<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'company_reference',
        'company_registration_number',
        'client_id',
        'company_renewal',
        'initial_payment_balance',
    ];

    public function clients() {
        return $this->belongsTo(Client::class, 'client_id');
    }
    
    public function payments(){
        return $this->hasMany(Payment::class, 'company_id');
    }
}