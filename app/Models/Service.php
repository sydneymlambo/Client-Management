<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'service_name',
        'service_quantity',
        'service_price',
    ];

    public function invoices() {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }
}
