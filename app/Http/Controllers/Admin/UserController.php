<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use App\Models\Income;
use App\Models\Investment;
use App\Models\Bank;
use App\Models\Withdraw;
use App\Models\BuyFund;

use Auth;
use DB;
use Log;
use Validator;
use Redirect;
use Helper;
use Storage;
use Hash;
use Carbon\Carbon;

class UserController extends Controller
{

    public function alluserlist(Request $request)
    {
        $limit = $request->limit ? $request->limit : paginationLimit();
        $status = $request->status ? $request->status : null;
        $search = $request->search ? $request->search : null;
        $notes = User::orderBy('id', 'ASC');

        if($search <> null && $request->reset!="Reset"){
            $notes = $notes->where(function($q) use($search){
              $q->Where('name', 'LIKE', '%' . $search . '%')
              ->orWhere('username', 'LIKE', '%' . $search . '%')
              ->orWhere('email', 'LIKE', '%' . $search . '%')
              ->orWhere('phone', 'LIKE', '%' . $search . '%')
              ->orWhere('jdate', 'LIKE', '%' . $search . '%')
              ->orWhere('active_status', 'LIKE', '%' . $search . '%');
            });

          }
                $notes = $notes->orderBy('id', 'ASC')->paginate($limit)
                    ->appends([
                        'limit' => $limit
                    ]);

                    $this->data['alluserlist'] =  $notes;
                    $this->data['search'] = $search;
                    $this->data['page'] = 'admin.users.alluserlist';
                    return $this->admin_dashboard();


    }


    public function active_users(Request $request)
    {
        $limit = $request->limit ? $request->limit : paginationLimit();
        $status = $request->status ? $request->status : null;
        $search = $request->search ? $request->search : null;
        $notes = User::where('active_status','Active')->orderBy('id', 'ASC');

       if($search <> null && $request->reset!="Reset"){
        $notes = $notes->where(function($q) use($search){
          $q->Where('name', 'LIKE', '%' . $search . '%')
          ->orWhere('username', 'LIKE', '%' . $search . '%')
          ->orWhere('email', 'LIKE', '%' . $search . '%')
          ->orWhere('phone', 'LIKE', '%' . $search . '%')
          ->orWhere('jdate', 'LIKE', '%' . $search . '%')
          ->orWhere('active_status', 'LIKE', '%' . $search . '%');
        });

      }
            $notes = $notes->paginate($limit)
                ->appends([
                    'limit' => $limit
                ]);

     $this->data['active_user'] =  $notes;
     $this->data['search'] = $search;
     $this->data['page'] = 'admin.users.active-user';
     return $this->admin_dashboard();

    }



        public function pending_users(Request $request)
        {
            $limit = $request->limit ? $request->limit : paginationLimit();
            $status = $request->status ? $request->status : null;
            $search = $request->search ? $request->search : null;
            $notes = User::where('active_status','Pending')->orderBy('id', 'ASC');

          if($search <> null && $request->reset!="Reset"){
            $notes = $notes->where(function($q) use($search){
              $q->Where('name', 'LIKE', '%' . $search . '%')
              ->orWhere('username', 'LIKE', '%' . $search . '%')
              ->orWhere('email', 'LIKE', '%' . $search . '%')
              ->orWhere('phone', 'LIKE', '%' . $search . '%')
              ->orWhere('jdate', 'LIKE', '%' . $search . '%')
              ->orWhere('active_status', 'LIKE', '%' . $search . '%');
            });

          }
                $notes = $notes->paginate($limit)
                    ->appends([
                        'limit' => $limit
                    ]);

        $this->data['active_user'] =  $notes;
        $this->data['search'] = $search;
        $this->data['page'] = 'admin.users.pending-user';
        return $this->admin_dashboard();

        }

    public function edit_users(Request $request)
    {
        $limit = $request->limit ? $request->limit : paginationLimit();
        $status = $request->status ? $request->status : null;
        $search = $request->search ? $request->search : null;
        $notes = User::orderBy('id', 'ASC');

        if($search <> null && $request->reset!="Reset"){
            $notes = $notes->where(function($q) use($search){
              $q->Where('name', 'LIKE', '%' . $search . '%')
              ->orWhere('username', 'LIKE', '%' . $search . '%')
              ->orWhere('email', 'LIKE', '%' . $search . '%')
              ->orWhere('phone', 'LIKE', '%' . $search . '%')
              ->orWhere('jdate', 'LIKE', '%' . $search . '%')
              ->orWhere('active_status', 'LIKE', '%' . $search . '%');
            });

          }
    $notes = $notes->paginate($limit)
        ->appends([
            'limit' => $limit
        ]);

        $this->data['edit_users'] =  $notes;
        $this->data['search'] = $search;
        $this->data['page'] = 'admin.users.edit-users';
        return $this->admin_dashboard();


    }

    public function edit_users_view($id)
    {

    try {
        $id = Crypt::decrypt($id);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
        return back()->withErrors(array('Invalid User!'));
    }

    $profile = User::where('id',$id)->first();
     $bank = Bank::where('user_id',$id)->first();
    $this->data['bank'] =  $bank;
    $this->data['profile'] =  $profile;
    $this->data['page'] = 'admin.users.users_profile_view';
    return $this->admin_dashboard();

   }

   public function users_profile_update(Request $request)

   {
       try{
           $validation =  Validator::make($request->all(), [
               'email' => 'required',
               'name' => 'required',
               'phone' => 'required|numeric'

           ]);

           if($validation->fails()) {
               Log::info($validation->getMessageBag()->first());

               return Redirect::back()->withErrors($validation->getMessageBag()->first())->withInput();
           }


           //check if email exist
         $post_array  = $request->all();
           $id=$post_array['id'];
         $update_data['name']=$post_array['name'];
         $update_data['phone']=$post_array['phone'];
         if(!empty($post_array['password']))
         {
           $update_data['password']= \Hash::make($post_array['password']);
         }
       //   $update_data['trx_addres']=$post_array['trx_addres'];
         $update_data['email']=$post_array['email'];
        //   $bank_array['account_holder']=$post_array['account_holder'];
        //   $bank_array['bank_name']=$post_array['bank_name'];
        //   $bank_array['branch_name']=$post_array['branch_name'];
        //   $bank_array['account_no']=$post_array['account_no'];
        //   $bank_array['user_id']=$id;
        //   $bank_array['ifsc_code']=$post_array['ifsc_code'];

         $user =  user::where('id',$id)->update($update_data);
        //  if(!empty($bank_array['account_holder']) && !empty($bank_array['account_no']))
        //  {
        //       Bank::updateOrCreate(['user_id'=>$id],$bank_array);
        //  }
       $notify[] = ['success', 'Updated successfully'];
       return redirect()->back()->withNotify($notify);

         }
          catch(\Exception $e){
           Log::info('error here');
           Log::info($e->getMessage());
           print_r($e->getMessage());
           die("hi");
           return back()->withErrors('error', $e->getMessage())->withInput();
           //return response(array('success'=>0,'statuscode'=>500,'msg'=>$e->getMessage()),500);
       }
   }



   public function block_users(Request $request)
    {
        $limit = $request->limit ? $request->limit : paginationLimit();
        $status = $request->status ? $request->status : null;
        $search = $request->search ? $request->search : null;
        $notes = User::wherein('active_status',array('Active','Block','Inactive'))->orderBy('id', 'DESC');;

        if($search <> null && $request->reset!="Reset"){
            $notes = $notes->where(function($q) use($search){
              $q->Where('name', 'LIKE', '%' . $search . '%')
              ->orWhere('username', 'LIKE', '%' . $search . '%')
              ->orWhere('email', 'LIKE', '%' . $search . '%')
              ->orWhere('phone', 'LIKE', '%' . $search . '%')
              ->orWhere('jdate', 'LIKE', '%' . $search . '%')
              ->orWhere('active_status', 'LIKE', '%' . $search . '%');
            });

          }
                $notes = $notes->paginate($limit)
                    ->appends([
                        'limit' => $limit
                    ]);

                    $this->data['active_user'] =  $notes;
                    $this->data['search'] = $search;
                    $this->data['page'] = 'admin.users.block-users';
                    return $this->admin_dashboard();


        }
        public function block_submit(Request $request)
        {

          $id= $request->id; // or any params
          $update_data['active_status']= $request->status;
          $user =  user::where('id',$id)->update($update_data);

        $notify[] = ['success', 'User '.$request->status.' successfully'];
        return redirect()->back()->withNotify($notify);
      }


      public function sellerSubmit(Request $request)
      {

        $id= $request->id; // or any params
        $update_data['rank']= 1;
        $user =  user::where('id',$id)->update($update_data);

      $notify[] = ['success', 'user rank updated successfully'];
      return redirect()->back()->withNotify($notify);
    }


    public function add_agent()
    {

      $this->data['page'] = 'admin.users.add_agent';
      return $this->admin_dashboard();

    }


    public function agent_post(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required|string|min:5',
            'role' => 'required',
        ]);
    
        // Check if the user already exists
        if (User::where('email', $request->email)->exists()) {
            return redirect()->back()->with('error', 'User already exists.');
        }
    
        // Generate a unique username
        do {
            $username = '000' . rand(1000, 9999);
        } while (User::where('username', $username)->exists());
    
        // Create a new user
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $username; // Assign the generated username
        $user->sponsor = '0';
        $user->ParentId = '0';
        $user->jdate = date('Y-m-d');
        $user->level = '0';
        $user->tpassword = '0';
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();
    
        $notify[] = ['success', 'Register successfully'];
        return redirect()->back()->withNotify($notify);
    }
    
               
    public function agent_history(Request $request)
    {

        $limit = $request->limit ? $request->limit : 100000000000;
        $status = $request->status ? $request->status : null;
        $search = $request->search ? $request->search : null;
        $notes = User::where('role','Agent')->orderBy('id', 'ASC');

        if($search <> null && $request->reset!="Reset")
        {
        $notes = $notes->where(function($q) use($search){
            $q->Where('username', 'LIKE', '%' . $search . '%')          
            ->orWhere('name', 'LIKE', '%' . $search . '%')
            ->orWhere('email', 'LIKE', '%' . $search . '%')
            ->orWhere('phone', 'LIKE', '%' . $search . '%')  
            ->orWhere('PSR', 'LIKE', '%' . $search . '%')                
            ->orWhere('role', 'LIKE', '%' . $search . '%');
          });
          }
        $notes = $notes->paginate($limit)
            ->appends([
                'limit' => $limit
            ]);

        $this->data['product_list'] =  $notes;
        $this->data['search'] = $search;
       $this->data['page'] = 'admin.users.agent_history';
        return $this->admin_dashboard(); 
    }

    public function vendor_history(Request $request)
    {

        $limit = $request->limit ? $request->limit : 100000000000;
        $status = $request->status ? $request->status : null;
        $search = $request->search ? $request->search : null;
        $notes = User::where('role','Vendor')->orderBy('id', 'ASC');

        if($search <> null && $request->reset!="Reset")
        {
        $notes = $notes->where(function($q) use($search){
            $q->Where('username', 'LIKE', '%' . $search . '%')          
            ->orWhere('name', 'LIKE', '%' . $search . '%')
            ->orWhere('email', 'LIKE', '%' . $search . '%')
            ->orWhere('phone', 'LIKE', '%' . $search . '%') 
            ->orWhere('PSR', 'LIKE', '%' . $search . '%')                 
            ->orWhere('role', 'LIKE', '%' . $search . '%');
          });
          }
        $notes = $notes->paginate($limit)
            ->appends([
                'limit' => $limit
            ]);

        $this->data['product_list'] =  $notes;
        $this->data['search'] = $search;
       $this->data['page'] = 'admin.users.vendor_history';
        return $this->admin_dashboard(); 
    }
       


    public function edit_member_post(Request $request)
    {
        try {
            // Validation rules
            $validation = Validator::make($request->all(), [
                'username' => 'required',
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'role' => 'required',
                'id' => 'required',
            ]);
    
            if ($validation->fails()) {
                Log::info($validation->getMessageBag()->first());
                return Redirect::back()->withErrors($validation->getMessageBag()->first())->withInput();
            }
    
            $user = User::where('id', $request->id)->first();
    
            if ($user) {
                $data = [
                    'username' => $request->username,
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'role' => $request->role,
                ];
    
    
                // Update the product with the new data
                User::where('id', $user->id)->update($data);
    
                $notify[] = ['success', 'User edited successfully'];
                return redirect()->back()->withNotify($notify);
            } else {
                return Redirect::back()->withErrors(['Meber User exist!']);
            }
        } catch (\Exception $e) {
            Log::info('error here');
            Log::info($e->getMessage());
            return Redirect::back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

      
      
    public function edit_member($id)
    {

    try {
        $id = Crypt::decrypt($id);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
        return back()->withErrors(array('Invalid User!'));
    }

    $product = User::where('id',$id)->first();

    $this->data['product'] =  $product;
    $this->data['page'] = 'admin.users.edit_member';
    return $this->admin_dashboard();

   }



   public function edit_vendor_post(Request $request)
   {
       try {
           // Validation rules
           $validation = Validator::make($request->all(), [
               'username' => 'required',
               'name' => 'required',
               'phone' => 'required',
               'email' => 'required',
               'role' => 'required',
               'id' => 'required',
           ]);
   
           if ($validation->fails()) {
               Log::info($validation->getMessageBag()->first());
               return Redirect::back()->withErrors($validation->getMessageBag()->first())->withInput();
           }
   
           $user = User::where('id', $request->id)->first();
   
           if ($user) {
               $data = [
                   'username' => $request->username,
                   'name' => $request->name,
                   'phone' => $request->phone,
                   'email' => $request->email,
                   'role' => $request->role,
               ];
   
   
               // Update the product with the new data
               User::where('id', $user->id)->update($data);
   
               $notify[] = ['success', 'User edited successfully'];
               return redirect()->back()->withNotify($notify);
           } else {
               return Redirect::back()->withErrors(['Meber User exist!']);
           }
       } catch (\Exception $e) {
           Log::info('error here');
           Log::info($e->getMessage());
           return Redirect::back()->withErrors(['error' => $e->getMessage()])->withInput();
       }
   }



   public function edit_vendor($id)
   {

   try {
       $id = Crypt::decrypt($id);
       } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
       return back()->withErrors(array('Invalid User!'));
   }

   $product = User::where('id',$id)->first();

   $this->data['product'] =  $product;
   $this->data['page'] = 'admin.users.edit_vendor';
   return $this->admin_dashboard();

  }



}


