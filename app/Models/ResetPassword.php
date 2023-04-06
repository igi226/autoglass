<?php


namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;  

class ResetPassword extends Model

{

    use HasFactory;
  

    public $table = "reset_password";

  

    /**

     * Write code on Method

     *

     * @return response()

     */

    protected $fillable = [

        'user_id',

        'token',

    ];
}
