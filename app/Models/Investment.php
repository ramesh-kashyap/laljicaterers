<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon; 
class Investment extends Model
{
    use HasFactory;

    protected $fillable = [
        'plan',
        'user_id_fk',
        'user_id',
        'amount',
        'grandTotal',
        'discount',
        'coupon',
        'sdate',
        'status',
        'transaction_id',
        'payment_mode',
        'active_from'
    ];
    

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    } 

    public static function countTodaysactiveted()
    {

       $data=Investment::where('sdate',Carbon::now()->format('Y-m-d'))->count();
       return ($data?$data:0);
   } 

    public static function counttotal_business()
    {

       $data=Investment::where('status','Active')->sum('amount');
       return ($data?$data:0);
   }

   public function userProduct()
    {
        return $this->hasMany('App\Models\User_product','invest_id');
    }

}
