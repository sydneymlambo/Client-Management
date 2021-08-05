<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Reminder extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'subject',
        'note',
        'email',
        'reminder_date',
    ];
    
    public function users() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
