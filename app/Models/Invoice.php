<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'billing_address',
        'invoice_number',
    ];

    public function companies() {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function services() {
        return $this->hasMany(Service::class, 'invoice_id');
    }
}
