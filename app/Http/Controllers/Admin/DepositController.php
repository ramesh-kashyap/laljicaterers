<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Investment;
use App\Models\Seller_invoice;
use App\Models\VendorBilling;

use App\Models\GeneralSetting;

use App\Models\User;

class DepositController extends Controller
{
    public function deposit_request(Request $request)
    {
        $limit = $request->limit ? $request->limit : paginationLimit();
        $status = $request->status ? $request->status : null;
        $search = $request->search ? $request->search : null;
        $notes = Investment::where('status','Pending')->orderBy('id', 'DESC');

        if($search <> null && $request->reset!="Reset"){
            $notes = $notes->where(function($q) use($search){
              $q->Where('amount', 'LIKE', '%' . $search . '%')
              ->orWhere('user_id_fk', 'LIKE', '%' . $search . '%')
              ->orWhere('sdate', 'LIKE', '%' . $search . '%')
              ->orWhere('status', 'LIKE', '%' . $search . '%')
              ->orWhere('transaction_id', 'LIKE', '%' . $search . '%');
            });

          }
    $notes = $notes->paginate($limit)
        ->appends([
            'limit' => $limit
        ]);

        $this->data['deposit_list'] =  $notes;
        $this->data['search'] = $search;
        $this->data['page'] = 'admin.deposit.deposit-request';
        return $this->admin_dashboard();
    }


    public function rejected_deposit(Request $request)
    {
        $limit = $request->limit ? $request->limit : paginationLimit();
        $status = $request->status ? $request->status : null;
        $search = $request->search ? $request->search : null;
        $notes = Investment::where('status','Pending')->orderBy('id', 'DESC');

        if($search <> null && $request->reset!="Reset"){
            $notes = $notes->where(function($q) use($search){
              $q->Where('amount', 'LIKE', '%' . $search . '%')
              ->orWhere('user_id_fk', 'LIKE', '%' . $search . '%')
              ->orWhere('sdate', 'LIKE', '%' . $search . '%')
              ->orWhere('status', 'LIKE', '%' . $search . '%')
              ->orWhere('transaction_id', 'LIKE', '%' . $search . '%');
            });

          }
    $notes = $notes->paginate($limit)
        ->appends([
            'limit' => $limit
        ]);

        $this->data['deposit_list'] =  $notes;
        $this->data['search'] = $search;
        $this->data['page'] = 'admin.deposit.rejected-deposit';
        return $this->admin_dashboard();
    }



    public function deposit_list(Request $request)
    {
        $limit = $request->limit ? $request->limit : paginationLimit();
        $status = $request->status ? $request->status : null;
        $search = $request->search ? $request->search : null;
        $notes = Seller_invoice::orderBy('id', 'DESC');

        if($search <> null && $request->reset!="Reset"){
            $notes = $notes->where(function($q) use($search){
                $q->Where('user_id_fk', 'LIKE', '%' . $search . '%')          
                ->orWhere('transaction_id', 'LIKE', '%' . $search . '%')
                ->orWhere('created_at ', 'LIKE', '%' . $search . '%')
                ->orWhere('name', 'LIKE', '%' . $search . '%')         
                ->orWhere('email', 'LIKE', '%' . $search . '%');
            });

          }
    $notes = $notes->paginate($limit)
        ->appends([
            'limit' => $limit
        ]);

        $this->data['product_list'] =  $notes;
        $this->data['search'] = $search;
        $this->data['page'] = 'admin.deposit.deposit-list';
        return $this->admin_dashboard();
    }


    public function vendor_billing(Request $request)
    {
        $limit = $request->limit ? $request->limit : paginationLimit();
        $status = $request->status ? $request->status : null;
        $search = $request->search ? $request->search : null;
        $notes = VendorBilling::orderBy('id', 'DESC');

        if($search <> null && $request->reset!="Reset"){
            $notes = $notes->where(function($q) use($search){
                $q->Where('user_id_fk', 'LIKE', '%' . $search . '%')          
                ->orWhere('transaction_id', 'LIKE', '%' . $search . '%')
                ->orWhere('created_at ', 'LIKE', '%' . $search . '%')
                ->orWhere('name', 'LIKE', '%' . $search . '%')         
                ->orWhere('email', 'LIKE', '%' . $search . '%');
            });

          }
    $notes = $notes->paginate($limit)
        ->appends([
            'limit' => $limit
        ]);

        $this->data['product_list'] =  $notes;
        $this->data['search'] = $search;
        $this->data['page'] = 'admin.deposit.vendor_billing';
        return $this->admin_dashboard();
    }




     



    public function Sellerinvoice(Request $request)
    {
        $limit = $request->limit ? $request->limit : paginationLimit();
        $status = $request->status ? $request->status : null;
        $search = $request->search ? $request->search : null;
        $notes = Seller_invoice::where('status','Active')->orderBy('id', 'DESC');

        if($search <> null && $request->reset!="Reset"){
            $notes = $notes->where(function($q) use($search){
              $q->Where('amount', 'LIKE', '%' . $search . '%')
              ->orWhere('user_id_fk', 'LIKE', '%' . $search . '%')
              ->orWhere('sdate', 'LIKE', '%' . $search . '%')
              ->orWhere('status', 'LIKE', '%' . $search . '%')
              ->orWhere('transaction_id', 'LIKE', '%' . $search . '%');
            });

          }
    $notes = $notes->paginate($limit)
        ->appends([
            'limit' => $limit
        ]);

        $this->data['deposit_list'] =  $notes;
        $this->data['search'] = $search;
        $this->data['page'] = 'admin.deposit.Sellerinvoice';
        return $this->admin_dashboard();
    }



    public function deposit_request_done(Request $request)
    {

       $id= $request->id ; // or any params
       $user_id= $request->user_Id ; // or any params
       $deposit_status= $request->deposit_status ; // or any params
        $user = Investment::where('id',$id)->first();

     if ($deposit_status=="success")
      {
         $users = User::where('id',$user_id)->first();
          $update_data['status']= 'Active'; 
           Investment::where('id',$id)->update($update_data); 
           
         if ($users->active_status=="Pending")
          {   
           $user_update=array('active_status'=>'Active','adate'=>Date("Y-m-d H:i:s"),'package'=>$user->amount);
          User::where('id',$user->user_id)->update($user_update);
         }
         else
         {
          $total = $users->package+$user->amount;
            $user_update=array('package'=>$total,'active_status'=>'Active',);
          User::where('id',$user->user_id)->update($user_update); 
         };

        $notify[] = ['success', 'Deposit request Approved successfully'];
        return redirect()->back()->withNotify($notify);
        }
        else
        {
            $update_data['status']= 'Decline'; 
    //   $user =  Investment::where('id',$id)->delete(); 
        Investment::where('id',$id)->update($update_data); 
        
        $notify[] = ['success', 'Deposit request Rejected successfully'];
        return redirect()->back()->withNotify($notify);
        }
   
   
     

   }
    


   public function view_invoice($id)
   {

   try {
       $id = Crypt::decrypt($id);
       } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
       return back()->withErrors(array('Invalid User!'));
   }

   $investment = Seller_invoice::where('id',$id)->first();

   $this->data['investment'] =  $investment;
   $this->data['page'] = 'admin.deposit.invoice';
   return $this->admin_dashboard();

  }



  public function view_vendor_invoice($id)
  {

  try {
      $id = Crypt::decrypt($id);
      } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
      return back()->withErrors(array('Invalid User!'));
  }

  $investment = VendorBilling::where('id',$id)->first();

  $this->data['investment'] =  $investment;
  $this->data['page'] = 'admin.deposit.view_vendor_invoice';
  return $this->admin_dashboard();

 }



  public function view_seller_invoice($id)
  {

  try {
      $id = Crypt::decrypt($id);
      } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
      return back()->withErrors(array('Invalid User!'));
  }

   $investment = Seller_invoice::where('id',$id)->first();

  $this->data['investment'] =  $investment;
  $this->data['page'] = 'admin.deposit.view_seller_invoice';
  return $this->admin_dashboard();

 }



}
