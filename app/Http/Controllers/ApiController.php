<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Validator;
 
use App\Http\Requests\VendorApiVendorLoginRequest; 
class ApiController extends Controller
{
    public function me() {
        return Auth::user();
    }
    
    public function loginApi(VendorApiVendorLoginRequest $request) {

        $data = $request->only('phone','password', 'type');

        // $phone = $request->post('phone');
        // $password = $request->post('password');
        // dd($phone);
    }

    public function register(Request $request) {
        $phone = $request->post('phone');
    }
    public function verification(Request $request) {
        $phone = $request->post('otp');
    }
    public function product() {
        $products = Product::where('user_id', Auth::id())->get();

        return $products;
    }

    public function search_products(Request $request) {
        

    }

    public function request_order(Request $request) {

    }

    public function purchases() {

    }

    public function purchase_details($id) {

    }

    public function track_order($id) {

    }

    public function confirm_order() {

    }
}
