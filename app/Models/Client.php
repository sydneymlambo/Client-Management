<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'client_surname',
        'client_id_number',
        'client_email',
        'client_cellphone',
        'client_type',
    ];

    public function companies() {
        return $this->hasMany(Company::class);
    }
}
