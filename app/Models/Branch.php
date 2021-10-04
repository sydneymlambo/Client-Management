<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'company_id',
        'contact',
        'address',
        'city',
        'postal_code',
    ];

    public function companies() {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
