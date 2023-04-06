<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'model',
        'make',
        'year',
        'type',
        'part_number',
        'brand',
        'description',
        'part_description',
        'price',
        'status',
        'approved'
    ];

    public function vendor_products() {
        return $this->hasMany(VendorProduct::class);
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($product) { // before delete() method call this
             $product->vendor_products()->delete();
             // do the rest of the cleanup...
        });
    }
}
