<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'invoice_number',
        'initial_balance',
        'payment_for',
        'payment_amount',
        'payment_date',
        'total_amount_outstanding',
    ];

    public function companies() {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
