<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendorApiRegistrationRequest;
use Illuminate\Http\Request;
use App\Http\Requests\VendorApiVendorLoginRequest;
use App\Jobs\Api\MailVerificationJob;
use App\Models\User;
// use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function signIn(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:8',
        ]);
        if ($validator->fails()) {

            return response()->json([
                'status' => 0,
                'msg' => 'Invalid entry for ' . array_keys($validator->errors()->messages())[0],

            ], 400);
        }
        $data = $request->only('email', 'password');
        if (Auth::attempt(["email" => $data["email"], "password" => $data["password"]]) && Auth::user()->status != 0) {
            $user = Auth::user();
            $user['token'] = $user->createToken('vendor_token')->plainTextToken;
            $response_data = $this->removeNull($user);

            $response = [
                'status' => '1',
                'msg' => 'User login successfully',
                'info' => $response_data,

            ];
            return response()->json($response, 200);
        } else {
            return response()->json([
                'status' => '0',
                'msg' => 'Incorrect Credentials'
            ], 400);

        }

    }
    public function removeNull($array)
    {
        array_walk_recursive($array, function (&$array, $key) {
            $array = (null === $array) ? '' : $array;
        });
        return $array;
    }

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            // 'phone' => 'required|numeric',
            'password' => 'required|string|min:8',
            'type' => 'required'
        ]);
        // dd(array_keys($validator->errors()->messages())[0]);
        // var_dump($validator->errors()->messages());
        if ($validator->fails()) {

            return response()->json([
                'status' => 0,
                'msg' => 'Invalid entry for ' . array_keys($validator->errors()->messages())[0],

            ], 400);
        }
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'type' => $request->type
            ]);
            $token = $user->createToken("vendor_token")->plainTextToken;
            dispatch(new MailVerificationJob($user, $token));
            return response()->json([
                'status' => true,
                'msg' => 'User Created Successfully',
                'token' => $token
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'msg' => $th->getMessage()
            ], 400);
        }

    }

    public function verifyEmail($token)
    {
        $personalToken = DB::table('personal_access_tokens')->where('token', $token)->select('tokenable_id')->first();
        $user = User::findOrfail($personalToken)->update(['email_verified_at' => date('Y-m-d H:i:s')]);
        return redirect('/verified');

    }
}