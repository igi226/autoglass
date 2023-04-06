<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Models\VendorProduct;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   public function getProducts( Request $request, VendorProduct $vendorProduct) {
      $request->validate([
         'part_number' => 'required|string'
      ]);
    $data = $request->only('search_type','part_number', 'location');
    // dd($data);
       return response()->json([
        'status' => 1,
        'data' => $vendorProduct->getAllProducts($data)
       ]);
   }
}
