<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'order_id',
        'image',
        'issue'
    ];

    public function order() {
        return $this->belongsTo(Order::class);
    }
}
