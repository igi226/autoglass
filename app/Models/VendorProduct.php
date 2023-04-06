<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'price',
        'commercial_price',
        'retail_price',
        'qty',
        'color',
        'description',
        'status',
        'location',
        'image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($vendor_product) { // before delete() method call this
            $vendor_product->orders()->delete();
            // do the rest of the cleanup...
        });
    }

    //api

    public function getAllProducts($data)
    {
        if($data['search_type'] == 'part_search'){
            // dd($data['search_type']);
            return VendorProduct::where('products.part_number', $data['part_number'])->join('products', 'vendor_products.product_id', 'products.id')->get();
        }
        return VendorProduct::get();
    }
}