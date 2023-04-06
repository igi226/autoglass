<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Http;
use App\Models\Notification;

if(!function_exists('get_user_details')) {
    function get_user_details() {
        return Auth::user();
    }
}
if(!function_exists('get_platform_commission')) {
    function get_platform_commission() {
        return 15;
    }
}
if(!function_exists('spreadsheet_to_array')) {
    function spreadsheet_to_array($file,$nullValue = null, $calculateFormulas = true, $formatData = false) {
        $results = [];
        $spreadsheet = IOFactory::load($file);
        foreach ($spreadsheet->getWorksheetIterator() as $key => $worksheet) {
            $results[$worksheet->getTitle()] = $worksheet->toArray($nullValue, $calculateFormulas, $formatData);
        }
        // save memory
        $spreadsheet->__destruct();
        $spreadsheet = NULL;
        unset($spreadsheet);
        return $results;
    }
}
if(!function_exists('generate_count')) {
    function generate_count($paginator) {
      return   1 +  (($paginator->currentPage() - 1) * $paginator->perPage());
    }
}
if(!function_exists('email_exists')) {
    function email_exists($email) {
        $users = DB::table('users')->where('email', $email)->get()->count();

        return $users;
    } 
}

if(!function_exists('BroadCastNotification')) {
    function BroadCastNotification($data) {
        $notification = Notification::create($data);
        $server = env('WEBSOCKET_SERVER').'/send';
        Http::post($server, [
            'user_id' => $notification->user_id,
            'message' => $notification->message,
            'url' => $notification->url,
            'timestamp' => $notification->created_at->format('H:i')
        ]);
    }
}

if(!function_exists('get_error_products')) {
    function get_error_products() {
        $products = DB::table('vendor_products')->where([
            'user_id' => Auth::id(),
            'commercial_price' => 0,
            'retail_price' => 0
        ])->get()->count();

        return $products;
    }
}

if(!function_exists('get_order_status')) {
    function get_order_status($status) {
        $statusArr = [
            3 => 'Paid',
            4 => 'Cancelled',
            5 => 'Dispatched',
            6 => 'Delivered',
            7 => 'Refund Requested',
            8 => 'Refund Declined',
            9 => 'Refund Accepted',
            10 => 'Order Completed!'
        ];

        return $statusArr[$status];
    }
}