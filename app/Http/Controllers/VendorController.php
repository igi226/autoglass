<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\Product;
use App\Models\User;
use App\Models\VendorProduct;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Report;
use App\Models\OrderStatus;
use App\Models\Refund;
use App\Models\ResetPassword;
use Stripe\StripeClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class VendorController extends Controller
{
    public function login()
    {
        return view('vendor.auth.login');
    }
    public function do_login(Request $request)
    {



        $data = $request->all();
        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return back()->with('error', 'Incorrect Email Address or Password!');

        }

        // $secret =env('GOOGLE_RECAPTCHA_SECRET');



        // $ch = curl_init();



        // curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");

        // curl_setopt($ch, CURLOPT_POST, 1);

        // curl_setopt($ch, CURLOPT_POSTFIELDS,"secret=".$secret."&response=".$data['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']);



        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // $result = curl_exec($ch);

        // $responseData = json_decode($result , TRUE);

        // curl_close ($ch);



        // if($responseData['success'] == false){

        // return back()->with('error', 'Incorrect captcha!');

        // }else{

        $credentials = [
            'email' => $data['email'],
            'password' => $data['password']
        ];

        if (Auth::attempt($credentials, true) && Auth::user()->status != 0 && Auth::user()->type == 1) {
            User::find(Auth::id())->update([
                'latitude' => $request->post('latitude'),
                'longitude' => $request->post('longitude'),
            ]);

            return redirect()->intended('/profile');
        }
        // }
        Auth::logout();
        return back()->with('error', 'Incorrect Email Address or Password!');
    }

    public function register()
    {
        return view('vendor.auth.register');
    }

    public function do_register(Request $request)
    {
        $data = $request->all();

        /* $rules = ['name' => 'required',
        'email' => 'required|email',
        'password' => 'required|confirmed'
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
        return back()->with('error', $validator->messages()->first());
        }*/



        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ];

        $messages = [
            'name.required' => 'Please enter name',
            'email.required' => 'Please enter email',
            'email.email' => 'Please enter valid email',
            'password.required' => 'Please enter password',
            'password_confirmation.required' => 'Please enter confirm password',
            'password.min' => 'Please enter password with minimum 6 characters',
            'password_confirmation.same' => 'Password Confirmation should match the Password',
        ];
        $validator = Validator::make($data, $rules, $messages);


        if ($validator->fails()) {
            $json_data = json_decode($validator->messages(), true);

            $msg = "";
            foreach ($json_data as $error) {
                $msg .= "<p>" . $error[0] . "</p>";
            }
            return back()->withInput($data)->with('error', $msg);
        }




        //     $secret =env('GOOGLE_RECAPTCHA_SECRET');
        //     $ch = curl_init();

        //     curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");

        //     curl_setopt($ch, CURLOPT_POST, 1);

        //     curl_setopt($ch, CURLOPT_POSTFIELDS,"secret=".$secret."&response=".$data['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']);



        //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //     $result = curl_exec($ch);

        //     $responseData = json_decode($result , TRUE);
        //     //print_r($responseData);
        //    // exit();

        //     curl_close ($ch);



        //     if($responseData['success'] == false){

        //     return back()->with('error', 'Incorrect captcha!');

        //     }else{


        if (email_exists($request->post('email'))) {
            return back()->with('error', 'Email Address already exists!');
        }

        $isSuccess = User::create([
            'name' => $request->post('name'),
            'email' => $request->post('email'),
            'password' => Hash::make($request->post('password')),
            'status' => 0,
            'type' => 1
        ]);

        if ($isSuccess) {
            return back()->with('success', "Registration Process is Successfull! You'll be notified after our Verification Procedure");
        }
        // }

        return back()->with('error', 'Error while trying to Register');
    }
    public function index()
    {
        $totalEarning = 0;
        $sales = Order::where([
            'vendor_id' => Auth::id(),
            'status' => 10
        ])->get();
        foreach ($sales as $sale) {
            $totalEarning += $sale->payments()->where('status', 1)->first()->amount;
        }
        $orderCount = Order::where('vendor_id', Auth::id())->get()->count();
        $saleCount = Order::where([
            'vendor_id' => Auth::id(),
            'status' => 10
        ])->get()->count();

        $orders = Order::where('vendor_id', Auth::id())->orderBy('id', 'desc')->limit(10)->get();

        return view('vendor.index', compact('totalEarning', 'orderCount', 'saleCount', 'orders'));
    }

    public function inventory(Request $request)
    {
        $search = $request->input('search');
        if ($search) {
            $products = Product::where('part_number', 'LIKE', "%{$search}%")
                ->orWhere('type', 'LIKE', "%{$search}%")
                ->orWhere('year', 'LIKE', "%{$search}%")
                ->orWhere('model', 'LIKE', "%{$search}%")
                ->where('approved', 1)
                ->orderBy('id', 'desc')
                ->paginate(50)
                ->appends(request()->query());

            return view('vendor.products.index', compact('products'));
        }
        $products = Product::where('approved', 1)->orderBy('id', 'desc')->paginate(50)->appends(request()->query());
        return view('vendor.products.index', compact('products'));
    }

    public function inventory_import(Request $request)
    {
        $productIds = $request->post('products');

        foreach ($productIds as $productId) {
            $product = Product::find($productId);
            $vendorproduct = VendorProduct::where([
                'user_id' => Auth::id(),
                'product_id' => $productId
            ])->get();
            if ($vendorproduct->count() != 0) {
                continue;
            }
            VendorProduct::create([
                'product_id' => $productId,
                'user_id' => Auth::id(),
                'price' => $product->price,
                'commercial_price' => $product->price,
                'retail_price' => $product->price,
                'description' => $product->description
            ]);
        }

        return true;
    }

    public function inventory_import_bulk(Request $request)
    {
        $filename = 'tmp_' . rand(10000, 99999) . '.xlsx';
        $request->file('file')->storeAs(
            '/public/tmp',
            $filename
        );
        $path = 'storage/tmp/' . $filename;
        $arrays = spreadsheet_to_array($path);
        @unlink($path);
        foreach ($arrays as $array) {
            foreach ($array as $key => $a) {
                if ($key == 0) {
                    continue;
                }
                if ($a[0] == NULL) {
                    return back()->with('error', 'Part Number are Required to Import Product!');
                }
                $product = Product::where([
                    'part_number' => $a[0]
                ])->first();

                if ($product == NULL) {
                    $newProduct = Product::create([
                        'year' => 0000,
                        'make' => 'Not Available',
                        'model' => 'Not Available',
                        'type' => 'Not Available',
                        'part_number' => $a[0],
                        'brand' => 'Not Available',
                        'description' => 'Not Available',
                        'part_description' => '',
                        'price' => 0,
                        'status' => 0,
                        'approved' => 0
                    ]);

                    VendorProduct::create([
                        'product_id' => $newProduct->id,
                        'user_id' => Auth::id(),
                        'price' => 0,
                        'commercial_price' => $a[1],
                        'retail_price' => $a[2],
                        'decription' => '',
                        'status' => 0
                    ]);
                } else {
                    VendorProduct::create([
                        'product_id' => $product->id,
                        'user_id' => Auth::id(),
                        'price' => $product->price,
                        'commercial_price' => $a[1],
                        'retail_price' => $a[2],
                        'decription' => $product->description,
                        'status' => 1
                    ]);
                }
            }
        }

        return back()->with('success', 'Product Imported!');
    }
    public function import_one(Request $request)
    {
        $newProduct = Product::create([
            'year' => $request->post('year'),
            'make' => $request->post('make'),
            'model' => $request->post('model'),
            'type' => $request->post('type'),
            'part_number' => $request->post('part_number'),
            'brand' => '',
            'description' => $request->post('description'),
            'part_description' => '',
            'price' => 0,
            'status' => 0,
            'approved' => 0
        ]);
        if ($newProduct) {
            VendorProduct::create([
                'product_id' => $newProduct->id,
                'user_id' => Auth::id(),
                'price' => 0,
                'commercial_price' => $request->post('commercial_price'),
                'retail_price' => $request->post('commercial_price'),
                'decription' => $request->post('description'),
                'status' => 0
            ]);
        }

        return back()->with('success', 'Product Request Submitted!');
    }
    public function pending_products()
    {
        $products = VendorProduct::where([
            'user_id' => Auth::id(),
            'status' => 1,
            'commercial_price' => 0,
            'retail_price' => 0
        ])->orderBy('id', 'desc')->paginate(20)->appends(request()->query());
        $page = [
            'heading' => 'Pending Products',
            'subheading' => 'Here is all available products in your Inventory. You can Customize Their Details As well.'
        ];
        return view('vendor.products.myproduct', compact('products', 'page'));
    }
    public function my_products(Request $request)
    {
        $page = [
            'heading' => 'Active Products',
            'subheading' => 'Here is all available products in your Inventory. You can Customize Their Details As well.'
        ];
        $products = VendorProduct::where([
            'user_id' => Auth::id(),
            'status' => 1,
            ['commercial_price', '!=', 0],
            ['retail_price', '!=', 0]
        ])->orderBy('id', 'desc')->paginate(20)->appends(request()->query());

        return view('vendor.products.myproduct', compact('products', 'page'));
    }

    public function delete_product($id)
    {
        $isSuccess = VendorProduct::find($id)->delete($id);

        if ($isSuccess) {
            return back()->with("success", "Product Deleted from Inventory");
        }

        return back()->with('error', 'Error while deleting Product!');
    }

    public function edit_product($id)
    {
        $product = VendorProduct::find($id);

        return view('vendor.products.edit', compact('product'));
    }

    public function update_product(Request $request, $id)
    {

        $data = $request->only('retail_price', 'commercial_price', 'qty', 'color', 'description', 'location');
        if ($request->has("image")) {
            $image = $request->file("image");
            $part_img = time() . rand(0000, 9999) . "." . $image->getClientOriginalExtension();
            $image->storeAs("public/PartImage", $part_img);
            $data["image"] = $part_img;
        }
        $isSuccess = VendorProduct::find($id)->update($data);
        // $isSuccess = VendorProduct::find($id)->update([
        //     'retail_price' => $request->post('retail_price'),
        //     'commercial_price' => $request->post('commercial_price'),
        //     'qty' => $request->post('qty'),
        //     'color' => $request->post('color'),
        //     'description' => $request->post('decsription'),
        //     'location' => $request->post('location'),
        //     'description' => $request->post('decsription'),
        // ]);

        if ($isSuccess) {
            return \redirect()->route('vendor.product.myproduct')->with('success', 'Product Details Updated!');
        }

        return back()->with('error', 'Error while updating Product!');
    }
    public function product_requests()
    {
        $products = VendorProduct::where([
            'user_id' => Auth::id(),
            'status' => 0
        ])->orderBy('id', 'desc')->paginate(30)->appends(request()->query());
        $page = [
            'heading' => 'Product Request',
            'subheading' => 'Your Product Requests. These will be added to the inventory after approval'
        ];
        return view('vendor.products.myproduct', compact('products', 'page'));
    }

    /*public function market(Request $request) {
    $search = $request->input('search');
    if($search) {
    $products = VendorProduct::where([
    ['commercial_price', '!=', 0],
    ['user_id', '!=', Auth::id()],
    ['status', '=', 1]
    ])->whereRelation('product', 'part_number', 'LIKE', "%{$search}%")
    ->orWhereRelation('product', 'year', 'LIKE', "%{$search}%")
    ->orWhereRelation('product', 'make', 'LIKE', "%{$search}%")
    ->orWhereRelation('product', 'model', 'LIKE', "%{$search}%")
    ->paginate(20)
    ->appends(request()->query());
    return view('vendor.market.index', compact('products'));
    }
    $advance =  $request->input('advance');
    if($advance) {
    $params = $request->except(['advance', '_token']);
    $query = [];
    foreach($params as $key => $value) {
    if($value == NULL) {
    continue;
    }
    $query[] = [$key, 'LIKE', "%{$value}%"];
    }
    $products = VendorProduct::whereRelation('product', $query)
    ->where([
    ['user_id', '!=', Auth::id()],
    ['status', '=', 1],
    ['commercial_price', '!=', 0]
    ])
    ->paginate(20)
    ->appends(request()->query());
    return view('vendor.market.index', compact('products'));
    }
    $products = VendorProduct::where([
    ['user_id', '!=', Auth::id()],
    ['status', '=', 1],
    ['commercial_price', '!=', 0]
    ])
    ->orderBy('id', 'desc')
    ->paginate(20)
    ->appends(request()->query());;
    return view('vendor.market.index', compact('products'));
    }*/
    public function market(Request $request)
    {
        $search = $request->input('search');
        $advance = $request->input('advance');
        
        if ($search) {
            $products = VendorProduct::where([
                ['commercial_price', '!=', 0],
                ['user_id', '!=', Auth::id()],
                ['status', '=', 1]
            ])->whereRelation('product', 'part_number', 'LIKE', "%{$search}%")
                ->orWhereRelation('product', 'year', 'LIKE', "%{$search}%")
                ->orWhereRelation('product', 'make', 'LIKE', "%{$search}%")
                ->orWhereRelation('product', 'model', 'LIKE', "%{$search}%")
                ->paginate(20)
                ->appends(request()->query());
                // dd($products);
            return view('vendor.market.index', compact('products'));
        } else if (isset($advance)) {
            //DB::enableQueryLog();
            $params = $request->except(['advance', '_token']);

            $query = DB::table('products')
                ->join('vendor_products', 'products.id', '=', 'vendor_products.product_id')
                ->join('users', 'users.id', '=', 'vendor_products.user_id')
                ->select('products.*', 'users.latitude', 'users.longitude', 'vendor_products.commercial_price', 'vendor_products.id AS ven_pro_id');
            $authid = Auth::id();
            $query->where(function ($q) use ($authid) {

                $q->whereRaw("vendor_products.user_id !='" . $authid . "' and vendor_products.status=1 and vendor_products.commercial_price!=0");

            });


            if (isset($params['type'])) {
                $type = $params['type'];
                $arr = explode(",", $type);


                if ($type != "") {
                    $query->where(function ($q) use ($arr) {

                        if (isset($arr[0])) {
                            $q->orWhereRaw("products.part_number like '%" . $arr[0] . "%'");
                        }

                        if (isset($arr[1])) {
                            //print_r($arr);

                            $q->orWhereRaw("products.part_number like '%" . $arr[1] . "%'");
                        }
                    });
                }
            }
            // exit();
            if (isset($params['year'])) {
                $year = $params['year'];
                if ($year != "") {
                    $query->where(function ($q) use ($year) {
                        $q->whereRaw("products.year = '" . $year . "'");
                    });
                }
            }
            if (isset($params['make'])) {
                $make = $params['make'];
                if ($make != "") {
                    $query->where(function ($q) use ($make) {
                        $q->whereRaw("products.make = '" . $make . "'");
                    });
                }
            }
            if (isset($params['model'])) {
                $model = $params['model'];
                if ($model != "") {
                    $query->where(function ($q) use ($model) {
                        $q->whereRaw("products.model = '" . $model . "'");
                    });
                }
            }
            if (isset($params['part_number'])) {
                $part_number = $params['part_number'];
                if ($part_number != "") {
                    $query->where(function ($q) use ($part_number) {
                        $q->whereRaw("products.part_number = '" . $part_number . "'");
                    });
                }
            }


            $products = $query->paginate(20)->appends(request()->query());

            return view('vendor.market.index', compact('products'));
        } else {
            $products = DB::table('products')
                ->join('vendor_products', 'vendor_products.product_id', '=', 'products.id')
                ->join('users', 'users.id', '=', 'vendor_products.user_id')
                ->select('products.*', 'users.latitude', 'users.longitude', 'vendor_products.commercial_price', 'vendor_products.id AS ven_pro_id')
                ->where([
                    ['vendor_products.user_id', '!=', Auth::id()],
                    ['vendor_products.status', '=', 1],
                    ['vendor_products.commercial_price', '!=', 0]
                ])
                ->paginate(20);


            return view('vendor.market.index', compact('products'));
        }
    }

    public function request_order(Request $request, $id)
    {
        $product = VendorProduct::find($id);
        // dd($product);

        $isSuccess = Order::create([
            'user_id' => Auth::id(),
            'vendor_id' => $product->user_id,
            'vendor_product_id' => $product->id,
            'unique_id' => "ORD" . rand(100000, 999999),
            'qty' => $request->post('qty'),
            'status' => 0
        ]);
        BroadCastNotification([
            'user_id' => $product->user_id,
            'message' => "There is a Product Request waiting for You. Please Check Availability of the Product.",
            'url' => route('vendor.orders.requests')
        ]);
        return back()->with('success', "Availability Checking, you'll be notified soon.");
    }
    public function mark_as_read()
    {
        $isSuccess = Auth::user()->notifications()->update([
            'status' => 1
        ]);

        return $isSuccess;
    }

    public function order_requests()
    {
        $orders = Order::where([
            'vendor_id' => Auth::id(),
            'status' => 0
        ])->orderBy('id', 'desc')->paginate(10)->appends(request()->query());
        ;

        return view('vendor.orders.request', compact('orders'));
    }

    public function order_requests_accept($id)
    {
        $order = Order::find($id);
        $isSuccess = $order->update([
            'status' => 1
        ]);
        BroadCastNotification([
            'user_id' => $order->user_id,
            'message' => "<b>Congradulations!!</b> Product is Available. Complete payment to get it to your doorstep.",
            'url' => route('vendor.order.invoice', ['id' => $order->id])
        ]);
        return $isSuccess;
    }
    public function order_requests_decline($id)
    {
        $order = Order::find($id);
        $isSuccess = $order->update([
            'status' => 2
        ]);
        BroadCastNotification([
            'user_id' => $order->user_id,
            'message' => "<b>Sorry!</b> Requested Product With Part Number {$order->vendor_product->product->part_number} isn't avaialble right Now. You can Look for another Vendor",
            'url' => 'javascript:void'
        ]);
        return $isSuccess;
    }

    public function notifications()
    {
        $notifications = Auth::user()->notifications()->orderBy('id', 'desc')->paginate(30);

        return view('vendor.notifications', compact('notifications'));
    }

    public function my_purchase()
    {
        $purchases = Order::where('user_id', Auth::id())
            ->whereIn('status', [1, 3, 5, 6, 10])
            ->orderBy('id', 'desc')
            ->paginate(30);

        return view('vendor.purchases.my', compact('purchases'));
    }
    public function cancel_purchase($id)
    {
        $order = Order::find($id);
        $isSuccess = $order->update([
            'status' => 4
        ]);
        BroadCastNotification([
            'user_id' => $order->vendor_id,
            'message' => "$order->unique_id Order is Cancelled by the Customer",
            'url' => 'javascript:void'
        ]);
        return $isSuccess;

    }

    public function order_invoice($id)
    {
        $order = Order::find($id);
        if ($order->status == 4) {
            abort(404);
        }
        $totalAmount = $order->qty * $order->vendor_product->commercial_price;
        $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));
        $intent = $stripe->paymentIntents->create([
            'amount' => $totalAmount * 100,
            'currency' => env('CURRENCY'),
            'payment_method_types' => ['card'],
        ]);

        return view('vendor.orders.payment', compact('order', 'intent'));
    }

    public function confirm_order(Request $request, $id)
    {
        $isSuccess = $request->input('redirect_status');

        if ($isSuccess == 'succeeded') {
            $order = Order::find($id);
            $order->update([
                'status' => 3
            ]);
            Payment::create([
                'order_id' => $id,
                'transaction_id' => $request->input('payment_intent'),
                'currency' => env('CURRENCY'),
                'amount' => $order->qty * $order->vendor_product->commercial_price,
                'status' => 1
            ]);
            OrderStatus::create([
                'order_id' => $id,
                'status' => 'Ordered',
                'comment' => 'Customer Completed Payment!'
            ]);
            BroadCastNotification([
                'user_id' => $order->vendor_id,
                'message' => "<b>Congradulations!!</b> {$order->user->name} Just Completed Payment To Purchase Your Product. Let's get busy To Deliver Best Service for your Consumer.",
                'url' => route('vendor.order.invoice', ['id' => $order->id])
            ]);

            return back()->with('success', 'Payment is successful! Vendor will Let you know the Status of the Delivery Asap.');
        }
        Payment::create([
            'order_id' => $id,
            'transaction_id' => 'Not Available',
            'currency' => env('CURRENCY'),
            'amount' => $order->qty * $order->vendor_product->commercial_price,
            'status' => 0
        ]);

        return back()->with('success', "An Error Occured! Please Try again after few moments");
    }

    public function profile()
    {
        $user = User::find(Auth::id());

        return view('vendor.profile', compact('user'));
    }

    public function update_profile(Request $request)
    {
        $isSuccess = User::find(Auth::id())->update($request->all());

        if ($isSuccess) {
            return back()->with('success', 'Profile Updated!');
        }
        return back()->with('error', 'Error while Updating Profile!');
    }

    public function avatar_update(Request $request)
    {
        if ($request->has('file')) {
            $filename = 'avatar_' . rand(10000, 99999) . '.png';
            $request->file('file')->storeAs(
                '/public/avatars',
                $filename
            );
            $oldFile = $request->post('old_file');
            @unlink("storage/avatars/{$oldFile}");

            $isSuccess = User::find(Auth::id())->update([
                'avatar' => $filename
            ]);

            return $isSuccess;
        }

        return false;
    }

    public function report(Request $request)
    {
        $imagename = '';
        $reference = 'REF_' . date('dmy-Hi') . '_' . rand(100000, 999999);
        if ($request->post('file') != '') {
            $base64image = explode('base64,', $request->post('file'))[1];
            $image = base64_decode($base64image);
            $imagename = 'report_' . rand(100000, 999999) . '.png';
            Storage::put('/public/reports/' . $imagename, $image);
        }
        $isSuccess = Report::create([
            'user_id' => Auth::id(),
            'reference' => $reference,
            'issue' => $request->post('issue'),
            'comment' => $request->post('comment'),
            'image' => $imagename
        ]);

        if ($isSuccess) {
            return json_encode([
                'status' => 200,
                'reference' => $reference
            ]);
        }

        return json_encode([
            'status' => 500
        ]);

    }

    public function track_order(Request $request)
    {
        $identity = $request->input('identity');
        $order = Order::where('unique_id', $identity)->first();
        if (!$order) {
            abort(404);
        }
        return view('vendor.orders.details', compact('order'));
    }

    public function orders(Request $request)
    {
        $search = $request->input('search');
        if ($search) {
            $orders = Order::where([
                ['vendor_id', '=', Auth::id()],
                ['status', '>', 2],
                ['unique_id', 'LIKE', "%{$search}%"]
            ])->paginate(50);
            return view('vendor.orders.index', compact('orders'));
        }
        $orders = Order::where([
            ['vendor_id', '=', Auth::id()],
            ['status', '>', 2]
        ])->paginate(50);

        return view('vendor.orders.index', compact('orders'));
    }

    public function order_update_status(Request $request, $id)
    {
        $order = Order::find($id);
        OrderStatus::create([
            'order_id' => $id,
            'status' => get_order_status($request->post('status')),
            'comment' => $request->post('comment')
        ]);
        $order->update([
            'status' => $request->post('status')
        ]);

        BroadCastNotification([
            'user_id' => $order->user_id,
            'message' => "Your Order is " . get_order_status($request->post('status')) . ". Know Current Status of your Order",
            'url' => route('vendor.order.track', ['identity' => $order->unique_id, 'access' => csrf_token()])
        ]);

        return back()->with('success', 'Order Status Updated Successfully!');
    }

    public function complete_order($id)
    {
        $order = Order::find($id);

        $order->update([
            'status' => 10
        ]);
        OrderStatus::create([
            'order_id' => $id,
            'status' => 'Order Completed!',
            'comment' => 'Customer confirmed the Order!'
        ]);
        BroadCastNotification([
            'user_id' => $order->vendor_id,
            'message' => "{$order->user->name} Confirmed Order! You'll receive payment for This Order Very Soon.",
            'url' => 'javascript:void'
        ]);

        return back()->with('success', 'Thanks for Confirmation! Hope you liked our Service.');
    }

    public function request_refund(Request $request, $id)
    {
        if ($request->has('file')) {
            $filename = 'refund_' . rand(10000, 99999) . '.png';
            $request->file('file')->storeAs(
                '/public/refunds',
                $filename
            );
            $isSuccess = Refund::create([
                'user_id' => Auth::id(),
                'order_id' => $id,
                'issue' => $request->post('issue'),
                'image' => $filename
            ]) && Order::find($id)->update([
                    'status' => 7
                ]) && OrderStatus::create([
                    'order_id' => $id,
                    'status' => 'Refund Requested',
                    'comment' => $request->post('issue')
                ]);
            BroadCastNotification([
                'user_id' => Order::find($id)->vendor_id,
                'message' => "Customer submitted a Refund Request. See request and Take a early action.",
                'url' => route('vendor.order.refunds')
            ]);

            if ($isSuccess) {
                return back()->with('success', 'A Refund Request Generated!');
            }

            return back()->with('error', 'A error occured while requesting!');
        }
    }

    public function refund_request()
    {
        $refunds = Refund::whereRelation('order', 'vendor_id', '=', Auth::id())->orderBy('id', 'desc')->paginate(30);

        return view('vendor.orders.refunds', compact('refunds'));
    }

    public function refund_action(Request $request, $id)
    {
        $order = Order::find($id);
        $status = $request->post('status');
        if ($status == 8) {
            $order->update([
                'status' => 8
            ]);
            OrderStatus::create([
                'order_id' => $id,
                'status' => 'Refund Declined',
                'comment' => $request->post('reply')
            ]);
            $order->refund()->update([
                'reply' => $request->post('reply')
            ]);
            BroadCastNotification([
                'user_id' => $order->user_id,
                'message' => "Refund Request Declined! " . $request->post('reply'),
                'url' => route('vendor.order.track', ['identity' => $order->unique_id, 'access' => csrf_token()])
            ]);

        } else if ($status == 9) {
            $order->update([
                'status' => 9
            ]);
            OrderStatus::create([
                'order_id' => $id,
                'status' => 'Refund Accepted',
                'comment' => $request->post('reply') . "(Note : It may take 5-10 business days for funds to settle."
            ]);
            $order->refund()->update([
                'reply' => $request->post('reply')
            ]);
            BroadCastNotification([
                'user_id' => $order->user_id,
                'message' => "Refund Request Accepted! " . $request->post('reply') . "(Note : It may take 5-10 business days for funds to settle.",
                'url' => route('vendor.order.track', ['identity' => $order->unique_id, 'access' => csrf_token()])
            ]);
            $payment_intent = $order->payments()->where('status', 1)->first()->transaction_id;
            $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));
            $stripe->refunds->create([
                'payment_intent' => $payment_intent
            ]);
            $order->payments()->where('status', 1)->update('status', 0);
        }

        return back()->with('success', 'Thanks for your reply to the Refund Request');
    }

    public function ajax_chart()
    {
        $months = [
            1,
            2,
            3,
            4,
            5,
            6,
            7,
            8,
            9,
            10,
            11,
            12
        ];

        $orders = [];
        $sales = [];
        foreach ($months as $month) {
            $order = Order::where('vendor_id', Auth::id())
                ->whereYear('created_at', now()->year)
                ->whereMonth('created_at', $month)
                ->count();
            $sale = Order::where([
                'vendor_id' => Auth::id(),
                'status' => 10
            ])
                ->whereYear('created_at', now()->year)
                ->whereMonth('created_at', $month)
                ->count();

            $sales[] = [$month - 1, $sale];
            $orders[] = [$month - 1, $order];
        }

        return view('vendor.chart', compact('sales', 'orders'));
    }
    public function displaymodel(Request $request)
    {
        $year = $request->input('year');
        $make = $request->input('make');
        if (($year != "") && ($make != "")) {

            //  DB::enableQueryLog();
            $query = DB::table('products')
                ->join('vendor_products', 'products.id', '=', 'vendor_products.product_id')
                ->join('users', 'users.id', '=', 'vendor_products.user_id')
                ->select('products.model');
            $authid = Auth::id();
            $query->where(function ($q) use ($authid, $year, $make) {

                $q->whereRaw("products.year ='" . $year . "' and products.make ='" . $make . "' and  vendor_products.user_id !='" . $authid . "' and vendor_products.status=1 and vendor_products.commercial_price!=0");

            });
            $query->groupBy('products.model');


            return json_encode(array($query->get()));

        }
    }
    public function forgot_password(Request $request)
    {

        if ($request->method() == 'POST') {

            $data = $request->all();
            $rules = ['email' => 'required|email'];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {

                return redirect()->route('vendor.forgot-password')->with('error', 'Incorrect Email Address!');

            }

            $mail_exists = User::where('email', '=', $request->post('email'))->count();
            if ($mail_exists == 1) {
                $token = Str::random(64);

                $member = User::where('email', '=', $request->post('email'))->first();

                ResetPassword::create([

                    'user_id' => $member['id'],

                    'token' => $token

                ]);


                Mail::send('vendor.emails.passwordReset', ['token' => $token], function ($message) use ($request) {

                    $message->to($request->post('email'));

                    $message->subject('Password Reset Email');
                    $message->from("autoglassb2b@autoglassb2b.com", "Glass Inventory");

                });
                return redirect()->route('vendor.forgot-password')->with(
                    [
                        'message1' => 'Please check your email and click on password reset link.',
                        'alert-type' => 'success',
                    ]
                );

            } else {
                return redirect()->route('vendor.forgot-password')->withInput()->with('error', 'Email does not exists!');
            }
        }


        return view('vendor.auth.forgot-password');
    }
    public function reset_password($token, Request $request)
    {
        $verifyUser = ResetPassword::where('token', $token)->count();


        if ($request->method() == 'POST') {
            $request->validate([
                'id' => ['required'],
                'token' => ['required'],
                'email' => ['required', 'email'],
                'password' => ['min:6', 'same:cpassword'],
                'cpassword' => ['required'],
            ]);

            //echo $request->post('id');
            //exit();


            $member = User::where('id', '=', $request->post('id'))
                ->update([
                    'password' => Hash::make($request->post('password'))
                ]);
            $message = "Password reset successfully.";

            return redirect()->route('vendor.login')->with(
                array(
                    'message2' => $message,
                    'alert-type' => 'success',
                )
            );


        } else {
            if ($verifyUser > 0) {
                $verifyUserData = ResetPassword::where('token', $token)->first();


                $member = User::where('id', '=', $verifyUserData['user_id'])->first();
                $token_data = array('token' => $token);
                return view('vendor.auth.reset-password', compact(array('token_data', 'member')));


            } else {
                //$member=array();
                return redirect()->route('vendor.login')->with('error', 'Error!Verification failed');
            }
        }

    }
    public function logout()
    {
        Auth::logout();

        return \redirect()->back();
    }
}