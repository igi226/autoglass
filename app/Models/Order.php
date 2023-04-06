<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vendor_id',
        'vendor_product_id',
        'status',
        'unique_id',
        'qty'
    ];

    public function vendor_product() {
        return $this->belongsTo(VendorProduct::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function vendor() {
        return $this->belongsTo(User::class, 'vendor_id');
    }
    public function payments() {
        return $this->hasMany(Payment::class);
    }
    public function order_statuses() {
        return $this->hasMany(OrderStatus::class);
    }

    public function refund() {
        return $this->hasOne(Refund::class);
    }
    public static function boot() {
        parent::boot();

        static::deleting(function($order){
            $order->payments()->delete();
            $order->order_statuses()->delete();
            $order->refund()->delete();
        });
    }
}
