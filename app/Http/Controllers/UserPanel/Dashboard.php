<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Investment;
use App\Models\Income;
use App\Models\Seller_invoice;
use Carbon\Carbon;


class Dashboard extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {

        $user=Auth::user();
        $limit = $request->limit ? $request->limit : paginationLimit();
          $status = $request->status ? $request->status : null;
          $search = $request->search ? $request->search : null;
          $notes = Seller_invoice::where('request_status','open')->orderBy('id','desc')->get();
        
        if($search <> null && $request->reset!="Reset"){
          $notes = $notes->where(function($q) use($search){
            $q->Where('user_id_fk', 'LIKE', '%' . $search . '%')
            ->orWhere('transaction_id', 'LIKE', '%' . $search . '%')
            ->orWhere('status', 'LIKE', '%' . $search . '%')
            ->orWhere('sdate', 'LIKE', '%' . $search . '%')
            ->orWhere('email', 'LIKE', '%' . $search . '%');
          });
  
        }
  
      
  
        $this->data['search'] =$search;
        $this->data['deposit_list'] =$notes;


      $this->data['page'] = 'user.dashboard';
      return $this->dashboard_layout();


    }



    public function my_level_team_count($userid,$level=10){
        $arrin=array($userid);
        $ret=array();

        $i=1;
        while(!empty($arrin)){
            $alldown=User::select('id')->whereIn('sponsor',$arrin)->get()->toArray();
            if(!empty($alldown)){
                $arrin = array_column($alldown,'id');
                $ret[$i]=$arrin;
                $i++;

            }else{
                $arrin = array();
            }
        }

        $final = array();
        if(!empty($ret)){
            array_walk_recursive($ret, function($item, $key) use (&$final){
                $final[] = $item;
            });
        }


        return $final;

    }

    public function my_direct_business_count($userid){

        $totalBusiness=0;
        $alldown=User::select('id')->where('sponsor',$userid)->get()->toArray();
        if(!empty($alldown)){
            $arrin = array_column($alldown,'id');

         $totalBusiness=Investment::whereIn('user_id',$arrin)->where('status','Active')->sum("amount");
        }
    return $totalBusiness;

    }


}
