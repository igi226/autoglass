<?php

namespace App\Http\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;

use App\Models\Product;
use App\Models\User;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware(function ($request, $next) {
            if(!Auth::check() || Auth::user()->type !== 2) {
                return redirect()->to('admin/login');
            }
            return $next($request);
        })->except(['login', 'do_login', 'logout']);
    }

    public function login() {
        return view('admin.auth.login');
    }

    public function do_login(Request $request) {
        $credentials = $request->validate([
            'email'=>'required',
            'password' => 'required'
        ]);
        $remember = $request->has('remember') ? 1 : 0;
        if(Auth::attempt($credentials, $remember) && Auth::user()->type == 2) {
            return redirect()->to('admin');
        }

        return back()->with('error', 'Wrong Credentials!');
    }
    public function logout() {
        Auth::logout();

        return back();
    }
    public function index() {
        return view('admin.index');
    }

    // Inventory

    public function product(Request $request) {
        $search = $request->input('search');
        if($search){
            $products = Product::where('part_number', 'LIKE', "%{$search}%")
            ->orWhere('type', 'LIKE', "%{$search}%")
            ->orWhere('year', 'LIKE', "%{$search}%")
            ->orWhere('model', 'LIKE', "%{$search}%")
            ->where('approved', 1)
            ->orderBy('id', 'desc')->paginate(50);

            return view('admin.products.index', compact('products'));
        }
        $products = Product::where('approved', 1)->orderBy('id', 'desc')->paginate(50);
        return view('admin.products.index', compact('products'));
    }

    public function add_product() {
        return view('admin.products.add');
    }

    public function create_product(Request $request) {
        $isSuccess = Product::create([
            'year' => $request->post('year'),
            'make' => $request->post('make'),
            'model' => $request->post('model'),
            'type' => $request->post('type'),
            'part_number' => $request->post('part_number'),
            'brand' => $request->post('brand'),
            'description' => $request->post('description'),
            'part_description' => $request->post('part_description'),
            'price' => $request->post('price'),
            'status' => $request->post('status'),
        ]);

        if($isSuccess) {
            return redirect()->to("admin/product")->with('success', 'A New Product Added!');
        }
        return back()->with("error", 'Error while Creating Product!');
    }

    public function import_product(Request $request) {
        $filename = 'tmp_'.rand(10000, 99999).'.xlsx';
        $request->file('file')->storeAs(
            '/public/tmp', $filename
        );
        $path = 'storage/tmp/'.$filename;
        $arrays =  spreadsheet_to_array($path);

        foreach($arrays as $array) {
            foreach($array as $key => $a) {
                if($key == 0) {
                    continue;
                }

                Product::create([
                    'year' => $a[0],
                    'make' => $a[1],
                    'model' => $a[2],
                    'type' => $a[3],
                    'part_number' => $a[4],
                    'description' => $a[5],
                    'brand' => $a[6],
                    'part_description' => $a[7],
                    'price' => intval(str_replace('$', '', $a[8])),
                    'status' => 1
                ]);
            }
        }
        @unlink($path);
        return back()->with('success', 'Products Imported!');
    }

    public function delete_all_product() {
        $isSuccess = Product::whereNotNull('id')->delete();

        if($isSuccess) {
            return back()->with('success', 'All Product Deleted!');
        }

        return back()->with('error', 'Error while Deleting All Product!');
    }

    public function delete_product($id) {
        $isSuccess = Product::find($id)->delete();

        if($isSuccess) {
            return back()->with('success', 'Product Deleted Successfully!');
        }

        return back()->with('error', 'Error while deleting Product');
    }

    public function update_product(Request $request, $id) {
        $isSuccess = Product::find($id)->update([
            'year' => $request->post('year'),
            'make' => $request->post('make'),
            'model' => $request->post('model'),
            'type' => $request->post('type'),
            'part_number' => $request->post('part_number'),
            'brand' => $request->post('brand'),
            'description' => $request->post('description'),
            'part_description' => $request->post('part_description'),
            'price' => $request->post('price'),
            'status' => $request->post('status'),
        ]);

        if($isSuccess) {
            return redirect()->to("admin/product")->with('success', 'Product Details Updated!');
        }
        return back()->with("error", 'Error while Updating Product!');
    }

    public function edit_product($id) {
        $product = Product::find($id);

        return view('admin.products.edit', compact('product'));
    }

    public function download_product() {
        $products = Product::all();

        $product_array = [
            ['Year', 'Make', 'Model','Type', 'Part Number', 'Description', 'Brand', 'Part Description', 'Cost', 'Created At']
        ];

        foreach($products as $product) {
            $product_array[] = [
                $product->year,
                $product->make,
                $product->model,
                $product->type,
                $product->part_number,
                $product->description,
                $product->brand,
                $product->part_description,
                $product->price.'$',
                $product->created_at->format('d F, Y')
            ];
        }
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->fromArray($product_array, NULL, 'A1');     

    // redirect output to client browser
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="products.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function product_requests(Request $request) {
        $search = $request->input('search');
        if($search){
            $products = Product::where('part_number', 'LIKE', "%{$search}%")
            ->where('approved','!=', 1)
            ->orWhere('type', 'LIKE', "%{$search}%")
            ->orWhere('year', 'LIKE', "%{$search}%")
            ->orWhere('model', 'LIKE', "%{$search}%")
            ->orderBy('id', 'desc')->paginate(50);

            return view('admin.products.request', compact('products'));
        }
        $products = Product::where('approved','!=', 1)->orderBy('id', 'desc')->paginate(50);
        return view('admin.products.request', compact('products'));
    }

    public function decline_product($id) {
        $isSuccess = Product::find($id)->update([
            'approved' => 2,
            'status' => 0
        ]);

        if($isSuccess) {
            return back()->with('success', 'Product Request Declined!');
        }

        return back()->with('error', 'Error while declining Product Request');
    }

    public function approve_product($id) {
        $isSuccess = Product::find($id)->update([
            'approved' => 1,
            'status' => 1
        ]) ||  Product::find($id)->vendor_products()->update([
            'status' => 1
        ]);

        if($isSuccess) {
            return back()->with('success', 'Product Request Accepted and Added to The database!');
        }

        return back()->with('error', 'Error while Accepting Product Request');
    }

    public function decline_product_all() {
        $isSuccess = Product::where('approved', 0)->update([
            'approved' => 2,
            'status' => 0
        ]);

        if($isSuccess) {
            return back()->with('success', 'Product Request Declined!');
        }

        return back()->with('error', 'Error while declining Product Request');
    }

    public function approve_product_all() {
        $isSuccess = Product::where('approved','!=', 1)->update([
            'approved' => 1,
            'status' => 1
        ]) || Product::where('approved','!=', 1)->vendor_products()->update([
            'status' => 1
        ]);

        if($isSuccess) {
            return back()->with('success', 'Product Request Accepted and Added to The database!');
        }

        return back()->with('error', 'Error while Accepting Product Request');
    }

    /**
     * ==========================
     * User management
     * ==========================
     */

     public function user(Request $request) {
        $search = $request->input('search');
        if($search){
            $users = User::where('name', 'LIKE', "%{$search}%")
            ->where('status', 1)
            ->orderBy('id', 'desc')->paginate(25);

            return view('admin.users.index', compact('users'));
        }
        $users = User::where('status', 1)->orderBy('id', 'desc')->paginate(25);
        return view('admin.users.index', compact('users'));
     }

     public function add_user() {
        return view("admin.users.add");
     }

     public function create_user(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);
        if(email_exists($request->post('email'))) {
            return back()->with('error', 'Email Address Belongs To Another User. Please try Another One!');
        }
        $isSuccess = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'company' => $request->company,
            'owner' => $request->owner,
            'password' => Hash::make($request->password),
            'type' => $request->post('type')
        ]);

        if($isSuccess) {
            return redirect()->to('admin/users')->with('success', 'New User Added Successfully!');
        }

        return back()->with('error', 'Error while creating a User!');
     }

     public function edit_user($id) {
        $user = User::find($id);

        return view('admin.users.edit', compact('user'));
     }

     public function update_user(Request $request, $id) {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $isSuccess = User::find($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'company' => $request->company,
            'owner' => $request->owner,
            'type' => $request->post('type')
        ]);

        if($isSuccess) {
            return redirect()->to('admin/users')->with('success', 'User Details Updated Successfully!');
        }

        return back()->with('error', 'Error while Updating a User!');
     }

     public function delete_user($id) {
        $isSuccess = User::find($id)->delete();

        if($isSuccess) {
            return back()->with('success', 'User Deleted Successfully!');
        }

        return back()->with('error', 'Error while deleting user!');
     }
     public function user_requests(Request $request) {
        $search = $request->input('search');
        if($search){
            $users = User::where('name', 'LIKE', "%{$search}%")
            ->where('status','!=', 1)
            ->orderBy('id', 'desc')->paginate(25);

            return view('admin.users.request', compact('users'));
        }
        $users = User::where('status','!=', 1)->orderBy('id', 'desc')->paginate(25);
        return view('admin.users.request', compact('users'));
     }
     public function approve_user($id) {
        $isSuccess = User::find($id)->update([
            'status' => 1
        ]);

        if($isSuccess) {
            return back()->with('success', 'User Approved!');
        }

        return  back()->with('error', 'Error while Approving user!');
     }

     public function change_password() {
        return view('admin.auth.change');
     }

     public function do_change_password(Request $request) {
        $isSuccess = User::find(Auth::id())->update([
            'password' => Hash::make($request->post('password'))
        ]);

        if($isSuccess) {
            return redirect()->to('admin')->with('success', 'Login Credential Updated!');
        }

        return back()->with('error', 'Error while updating Login Credentials!');
     }

     public function download_user() {
        $users = User::all();

        $userArray = [
            ['Name', 'Email', 'Mobile No.' , 'Address', 'Tax Id', 'Company', 'Owner', 'Category', 'Joined']
        ];

        foreach($users as $user) {
            if($user->type == 2) {
                $userCategory = 'Administrator';
            }
            else if($user->type == 1) {
                $userCategory = 'Vendor/Buyer';
            }
            else {
                $userCategory = 'General Customer';
            }
            $userArray[] = [
                $user->name,
                $user->email,
                $user->phone,
                $user->address,
                $user->company,
                $user->owner,
                $userCategory,
                $user->created_at->format('d F, Y')
            ];
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->fromArray($userArray, NULL, 'A1');     

    // redirect output to client browser
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="users.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
     }

}