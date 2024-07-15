<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Vproduct;
use App\Models\Seller_product;
use App\Models\Admin_product;
use App\Models\Seller_invoice;
use App\Models\VendorBilling;
use App\Models\Investment;
use App\Models\GeneralSetting;
use App\Models\Vendor_product;
use App\Models\Category;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Log;
use Redirect;
use Auth;
use DB;

class ProductController extends Controller
{
    


    public function index()
{
    // Query to fetch data from categories table
    $categories = DB::table('categories')->get();

    // dd($categories);
    // Pass the data to the view
    $this->data['categories'] = $categories;
    $this->data['page'] = 'admin.products.add-products';

    return $this->admin_dashboard(); 
}

    public function category()
    {
    
       $this->data['page'] = 'admin.products.category';
        return $this->admin_dashboard(); 
    }

    public function billing_product()
    {

          \DB::statement("SET SQL_MODE=''");
         $product = Admin_product::where('admin_id',Auth::guard('admin')->user()->id)->where('activeStatus',1)->orderBy('id','DESC')->groupBy('product_id')->get();
         $this->data['product'] = $product;
    
       $this->data['page'] = 'admin.products.seller.billing-products';
        return $this->admin_dashboard(); 
    }

    
    
    public function admin_product()
    {

        $product = Product::orderBy('id','DESC')->get();
         $this->data['product'] = $product;
    
       $this->data['page'] = 'admin.products.admin.billing-products';
        return $this->admin_dashboard(); 
    }

    
    

    public function productList(Request $request)
    {

        $limit = $request->limit ? $request->limit : 100000000000;
        $status = $request->status ? $request->status : null;
        $search = $request->search ? $request->search : null;
        $notes = Product::orderBy('id', 'DESC');

        if($search <> null && $request->reset!="Reset")
        {
        $notes = $notes->where(function($q) use($search){
            $q->Where('productName', 'LIKE', '%' . $search . '%')          
            ->orWhere('productPrice', 'LIKE', '%' . $search . '%')
            ->orWhere('productDiscountPrice', 'LIKE', '%' . $search . '%')
            ->orWhere('ProductCoupon', 'LIKE', '%' . $search . '%')         
            ->orWhere('ProducDiscription', 'LIKE', '%' . $search . '%');
          });
          }
        $notes = $notes->paginate($limit)
            ->appends([
                'limit' => $limit
            ]);

        $this->data['product_list'] =  $notes;
        $this->data['search'] = $search;
       $this->data['page'] = 'admin.products.productList';
        return $this->admin_dashboard(); 
    }


    public function product_request(Request $request)
    {

        $limit = $request->limit ? $request->limit : 100000000000;
        $status = $request->status ? $request->status : null;
        $search = $request->search ? $request->search : null;
        $notes = Investment::where('status','Pending')->orderBy('id', 'DESC');

        if($search <> null && $request->reset!="Reset")
        {
        $notes = $notes->where(function($q) use($search){
            $q->Where('user_id_fk', 'LIKE', '%' . $search . '%')          
            ->orWhere('amount', 'LIKE', '%' . $search . '%')
            ->orWhere('discount', 'LIKE', '%' . $search . '%')
            ->orWhere('status', 'LIKE', '%' . $search . '%')    
            ->orWhere('	payment_mode', 'LIKE', '%' . $search . '%')              
            ->orWhere('transaction_id', 'LIKE', '%' . $search . '%');
          });
          }
        $notes = $notes->paginate($limit)
            ->appends([
                'limit' => $limit
            ]);

        $this->data['product_list'] =  $notes;
        $this->data['search'] = $search;
       $this->data['page'] = 'admin.products.seller.product_request';
        return $this->admin_dashboard(); 
    }




    public function sellerProduct(Request $request)
    {

        $limit = $request->limit ? $request->limit : 100000000000;
        $status = $request->status ? $request->status : null;
        $search = $request->search ? $request->search : null;
        $notes = Investment::where('status','Active')->orderBy('id', 'DESC');

        if($search <> null && $request->reset!="Reset")
        {
        $notes = $notes->where(function($q) use($search){
            $q->Where('productName', 'LIKE', '%' . $search . '%')          
            ->orWhere('productPrice', 'LIKE', '%' . $search . '%')
            ->orWhere('productDiscountPrice', 'LIKE', '%' . $search . '%')
            ->orWhere('ProductCoupon', 'LIKE', '%' . $search . '%')         
            ->orWhere('ProducDiscription', 'LIKE', '%' . $search . '%');
          });
          }
        $notes = $notes->paginate($limit)
            ->appends([
                'limit' => $limit
            ]);

        $this->data['product_list'] =  $notes;
        $this->data['search'] = $search;
       $this->data['page'] = 'admin.products.seller.sellerProduct';
        return $this->admin_dashboard(); 
    }



    public function adminProduct(Request $request)
    {

        $limit = $request->limit ? $request->limit : 100000000000;
        $status = $request->status ? $request->status : null;
        $search = $request->search ? $request->search : null;
        $notes = Admin_product::where('activeStatus',1)->orderBy('id', 'DESC');

        if($search <> null && $request->reset!="Reset")
        {
        $notes = $notes->where(function($q) use($search){
            $q->Where('productName', 'LIKE', '%' . $search . '%')          
            ->orWhere('productPrice', 'LIKE', '%' . $search . '%')
            ->orWhere('productDiscountPrice', 'LIKE', '%' . $search . '%')
            ->orWhere('ProductCoupon', 'LIKE', '%' . $search . '%')         
            ->orWhere('ProducDiscription', 'LIKE', '%' . $search . '%');
          });
          }
        $notes = $notes->paginate($limit)
            ->appends([
                'limit' => $limit
            ]);

        $this->data['product_list'] =  $notes;
        $this->data['search'] = $search;
       $this->data['page'] = 'admin.products.admin.adminProduct';
        return $this->admin_dashboard(); 
    }




    public function product_request_done_multiple(Request $request)
    {
        $product_id = $request->input('checkedid');
        
        // dd($product_id);
        if(is_array($product_id))
        {
          foreach ($product_id as $key => $value) {
  
            
            if ($request->input('submit')=="Approved") 
            {
              $status= 1;
              $update_data['activeStatus']= 1; 
              $user =  Seller_product::where('id',$value)->update($update_data); 

            }
            else
            {
                $user =  Seller_product::where('id',$value)->delete(); 
            }
            
          }
       
       $notify[] = ['success', 'Product request '.$request->input('submit').' successfully'];
       return redirect()->back()->withNotify($notify);
        }
        else
        {
            return back()->withErrors(array(' Record not found!'));  
        }
       
    }

    


    public function addProduct(Request $request)
    {

    try{
        $validation =  Validator::make($request->all(), [
            'productName' => 'required',
            'productPrice' => 'required|numeric',
            'category_id' => 'required',
            'productDiscountPrice' => 'required',
            // 'type' => 'required',
            'ProductDiscription' => 'required',
            'icon_image'=>'max:4096|mimes:jpeg,png,jpg,svg,webp',

        ]);


        if($validation->fails()) {
            Log::info($validation->getMessageBag()->first());

            return Redirect::back()->withErrors($validation->getMessageBag()->first())->withInput();
        }

    
        $product=Product::where('productName',$request->productName)->first();
            if (!$product)          
            {
                $icon_image = $request->file('icon_image');
                $imageName = time().'.'.$icon_image->extension();
                $request->icon_image->move(public_path('image/'),$imageName);
                
                
           $data = [
                'productName' =>$request->productName,
                'productPrice' =>$request->productPrice,
                'category_id' =>$request->category_id,
                'productDiscountPrice' => $request->productDiscountPrice,
                // 'productName' =>$request->type,
                'ProductCoupon' => 0,
                'ProductDiscription' => $request->ProductDiscription,
                 'image' => 'image/'.$imageName,
            ];
            $payment = Product::firstOrCreate(['productName'=>$request->name],$data);

            $notify[] = ['success', ' Product Added successfully'];
            return redirect()->back()->withNotify($notify);

          
               # code...
           }
          else
          {
            return Redirect::back()->withErrors(array('Products already Exists! '));
          }

        }
       catch(\Exception $e){
        Log::info('error here');
        Log::info($e->getMessage());
        print_r($e->getMessage());
        die("hi");
        return  Redirect::back()->withErrors('error', $e->getMessage())->withInput();
        }


        }



        public function categorie(Request $request)
        {
            try {
                // Validate the request data
                $validation = Validator::make($request->all(), [
                    'categoryname' => 'required',
                    // 'status' => 'required',
                ]);
        
                if ($validation->fails()) {
                    Log::info($validation->getMessageBag()->first());
                    return Redirect::back()->withErrors($validation->getMessageBag()->first())->withInput();
                }
        
                // Check if the category already exists
                $category = Categorie::where('categoryname', $request->categoryname)->first();
                // dd($category);
                if (!$category) {
                    // Prepare the data for insertion
                    $data = [
                        'categoryname' => $request->categoryname,
                        // 'status' => $request->status,
                    ];
        
                    // Insert the category
                    Categorie::create($data);
        
                    $notify[] = ['success', 'Category added successfully'];
                    return redirect()->back()->withNotify($notify);
                } else {
                    return Redirect::back()->withErrors(['Category already exists!']);
                }
            } catch (\Exception $e) {
                Log::info('error here');
                Log::info($e->getMessage());
                return Redirect::back()->withErrors('error', $e->getMessage())->withInput();
            }
        }

        public function approvedProduct(Request $request)
        {
            try {
                // Enable query logging
                DB::enableQueryLog();
        
                // Validate request
                $validation = Validator::make($request->all(), [
                    'products' => 'required|array',
                    'quantity' => 'required|array',
                    'cartTotal' => 'required|numeric',
                    'grandTotal' => 'required|numeric',
                    'DiscountTotal' => 'required|numeric',
                    'CouponTotal' => 'required|numeric',
                    'investId' => 'required|exists:investments,id,user_id,' . Auth::id(),
                ]);
        
                if ($validation->fails()) {
                    return redirect()->route('admin.product-request')
                        ->withErrors($validation)
                        ->withInput();
                }
        
                $user_detail = Auth::user();
                $products = $request->products;
                $quantities = $request->input('quantity', []);
                $cartTotal = $request->input('cartTotal');
                $grandTotal = $request->input('grandTotal');
                $DiscountTotal = $request->input('DiscountTotal');
                $CouponTotal = $request->input('CouponTotal');
                $investId = $request->input('investId');
        
                // Find investment by investId
                $investment = Investment::findOrFail($investId);
        
                Log::info('Updating investment: ', ['investment' => $investment->toArray()]);
        
                // Update each attribute individually
                $investment->amount = $cartTotal;
                $investment->grandTotal = $grandTotal;
                $investment->status = "Active";
                $investment->discount = $DiscountTotal;
                $investment->coupon = $CouponTotal;
                $investment->updated_at = now();
        
                // Save the investment
                $investment->save();
        
                Log::info('Investment after save: ', ['investment' => $investment->toArray()]);
        
                // Update product data
                foreach ($products as $key => $id) {
                    $vendorProducts = Vendor_product::where('id', $id)->first();
                    $vid = $vendorProducts->product_id;
        
                    $productReport = Vproduct::where('id', $vid)->first();
                    $quantity = $quantities[$key] ?? 1;
        
                    $updateProduct = [
                        'quantity' => $quantity,
                        'productPrice' => $productReport->productPrice,
                        'activeStatus' => 1,
                        'grandTotal' => $productReport->productPrice * $quantity,
                        'discount' => ($productReport->productPrice * $quantity) - ($productReport->productDiscountPrice * $quantity),
                        'netAmount' => $productReport->productDiscountPrice * $quantity,
                        'updated_at' => now(),
                    ];
        
                    $vendorProduct = Vendor_product::where('id', $id)->where('user_id', $user_detail->id)->first();
                    if ($vendorProduct) {
                        $vendorProduct->update($updateProduct);
                    } else {
                        // Handle case where product is not found, maybe create it
                        $insertProduct = array_merge($updateProduct, [
                            'user_id' => $user_detail->id,
                            'product_id' => $vid,
                            'activeStatus' => 0,
                            'invest_id' => $investment->id,
                            'created_at' => now(),
                        ]);
                        Vendor_product::create($insertProduct);
                    }
                }
        
                // Get the executed queries from the query log
                $queries = DB::getQueryLog();
                Log::debug('Executed SQL Queries: ', $queries);
        
                $notify[] = ['success', 'Product Approved successfully'];
                return redirect()->route('admin.product-request')->withNotify($notify);
            } catch (\Exception $e) {
                Log::error('Cart update error: ' . $e->getMessage());
                return redirect()->route('admin.product-request')
                    ->withErrors($e->getMessage())
                    ->withInput();
            }
        }
        

        

 public function editProduct(Request $request)
 {
     try {
         // Validation rules
         $validation = Validator::make($request->all(), [
             'productName' => 'required',
             'productPrice' => 'required|numeric',
             'productDiscountPrice' => 'required',
             'ProductCoupon' => 'required',
             'ProductDiscription' => 'required',
             'id' => 'required',
             'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048' // Add validation for the image
         ]);
 
         if ($validation->fails()) {
             Log::info($validation->getMessageBag()->first());
             return Redirect::back()->withErrors($validation->getMessageBag()->first())->withInput();
         }
 
         $product = Product::where('id', $request->id)->first();
 
         if ($product) {
             $data = [
                 'productName' => $request->productName,
                 'productPrice' => $request->productPrice,
                 'productDiscountPrice' => $request->productDiscountPrice,
                 'ProductCoupon' => $request->ProductCoupon,
                 'ProductDiscription' => $request->ProductDiscription,
             ];
 
             // Check if an image file is present in the request
             if ($request->hasFile('image')) {
                 // Get the file from the request
                 $image = $request->file('image');
                 // Define the image path
                 $imagePath = 'public/images/';
                 // Generate a unique name for the image
                 $imageName = time() . '_' . $image->getClientOriginalName();
                 // Move the image to the specified path
                 $image->move(public_path($imagePath), $imageName);
                 // Save the image URL in the data array
                 $data['image'] = $imagePath . $imageName;
             }
 
             // Update the product with the new data
             Product::where('id', $product->id)->update($data);
 
             $notify[] = ['success', 'Product edited successfully'];
             return redirect()->back()->withNotify($notify);
         } else {
             return Redirect::back()->withErrors(['Products already exist!']);
         }
     } catch (\Exception $e) {
         Log::info('error here');
         Log::info($e->getMessage());
         return Redirect::back()->withErrors(['error' => $e->getMessage()])->withInput();
     }
 }
 

            

        public function edit_product($id)
        {
    
        try {
            $id = Crypt::decrypt($id);
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return back()->withErrors(array('Invalid User!'));
        }
    
        $product = Product::where('id',$id)->first();
    
        $this->data['product'] =  $product;
        $this->data['page'] = 'admin.products.edit-product';
        return $this->admin_dashboard();
    
       }


                 

      
       public function confirm_product($id)
       {
           try {
               $id = Crypt::decrypt($id);
           } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
               return back()->withErrors(['Invalid User!']);
           }
       
           // Retrieve the investment and associated products
           $investment = Investment::where('id', $id)->first();
           if (!$investment) {
               return back()->withErrors(['Investment not found!']);
           }
       
           $invest_id = $investment->id;
           $products = Vendor_product::where('invest_id', $invest_id)->get();
       
           // Pass data to view
           $this->data['investment'] = $investment;
           $this->data['products'] = $products;
           $this->data['page'] = 'admin.products.confirm_product';
       
           // Render admin dashboard view
           return $this->admin_dashboard();
       }
       




       public function deleteProduct(Request $request)
       {
   
          $id= $request->id ; // or any params

     
          $product = Product::where('id',$id)->delete();
          $notify[] = ['success', 'Product Edit successfully'];
        return redirect()->back()->withNotify($notify);
        
      
      
        
   
      }
      

      public function rejectProduct(Request $request)
      {
          // Retrieve the ID from the request
          $id = $request->id;
      
          // Find the product by ID
          $product = Investment::where('id', $id)->first();
      
          // Check if the product exists
          if ($product) {
              // Update the status to "Reject"
              $product->status = 'Reject';
      
              // Save the changes
              $product->save();
      
              // Prepare the success notification
              $notify[] = ['success', 'Product rejected successfully'];
          } else {
              // Prepare the failure notification if the product is not found
              $notify[] = ['error', 'Product not found'];
          }
      
          // Redirect back with the notification
          return redirect()->back()->withNotify($notify);
      }
      
     

     
    public function billingToSeller(Request $request)
    {

    try{
        $validation =  Validator::make($request->all(), [
            'product' => 'required',
            'username' => 'required|exists:users,username',
        ]);


        if($validation->fails()) {
            Log::info($validation->getMessageBag()->first());

            return Redirect::back()->withErrors($validation->getMessageBag()->first())->withInput();
        }

        $userDetail= User::where('username',$request->username)->where('rank',1)->first();

        if (!$userDetail) {
            return Redirect::back()->withErrors(array('User not an seller! '));
        }
        $product = Admin_product::where('id',$request->product)->first();
        $this->data['product'] =  $product;
        $this->data['username'] =  $request->username;
        $this->data['page'] = 'admin.products.seller.confirm_product_seller';
        return $this->admin_dashboard();

    
        }
       catch(\Exception $e){
        Log::info('error here');
        Log::info($e->getMessage());
        print_r($e->getMessage());
        die("hi");
        return  Redirect::back()->withErrors('error', $e->getMessage())->withInput();
        }



        }



   public function billingToAdmin(Request $request)
    {

    try{
        $validation =  Validator::make($request->all(), [
            'product' => 'required',
            'username' => 'required',
        ]);


        if($validation->fails()) {
            Log::info($validation->getMessageBag()->first());

            return Redirect::back()->withErrors($validation->getMessageBag()->first())->withInput();
        }

      
        $product = Product::where('id',$request->product)->first();
        $this->data['product'] =  $product;
        $this->data['username'] =  Auth::guard('admin')->user()->username;
        $this->data['page'] = 'admin.products.admin.confirm_product_admin';
        return $this->admin_dashboard();

    
        }
       catch(\Exception $e){
        Log::info('error here');
        Log::info($e->getMessage());
        print_r($e->getMessage());
        die("hi");
        return  Redirect::back()->withErrors('error', $e->getMessage())->withInput();
        }



        }




    public function billingSubmitSeller(Request $request)
    {

    try{
        $validation =  Validator::make($request->all(), [
            'product_id' => 'required',
            'cartTotal' => 'required|numeric',
            'grandTotal' => 'required',
            'DiscountTotal' => 'required',
            'CouponTotal' => 'required',
            'quantity' => 'required',
            'productPrice' => 'required',
            'username' => 'required',
            

        ]);


        if($validation->fails()) {
            Log::info($validation->getMessageBag()->first());

            return redirect()->route('admin.billing-product')->withErrors($validation->getMessageBag()->first())->withInput();
        }
    
        $product=Product::where('id',$request->product_id)->first();
            if ($product)          
            {
          $userDetail= User::where('username',$request->username)->where('rank',1)->first();

           $data = [
                'quantity' =>$request->quantity,
                'netAmount' =>$request->cartTotal,
                'grandTotal' => $request->grandTotal,
                'discount' => $request->DiscountTotal,
                'coupon' => $request->CouponTotal,
                'productPrice' => $request->productPrice,
                'product_id' => $request->product_id,
                'user_id' => $userDetail->id,
                'activeStatus' =>1,
            ];
            $payment = Seller_product::create($data);
            $notify[] = ['success', ' Product Added successfully'];
            return redirect()->route('admin.billing-product
            
            ')->withNotify($notify);
               # code...
           }
          else
          {
            return redirect()->route('admin.billing-product')->withErrors(array('Products not found! '));
          }

        }
       catch(\Exception $e){
        Log::info('error here');
        Log::info($e->getMessage());
        print_r($e->getMessage());
        die("hi");
        return  redirect()->route('admin.product-request')->withErrors('error', $e->getMessage())->withInput();
        }



 }
 public function vendor_product(Request $request)
 {

 try{
     $validation =  Validator::make($request->all(), [
         'productName' => 'required',
         'productPrice' => 'required|numeric',
        //  'category_id' => 'required',
         'productDiscountPrice' => 'required',
         // 'type' => 'required',
         'ProductDiscription' => 'required',
        //  'icon_image'=>'max:4096|mimes:jpeg,png,jpg,svg,webp',

     ]);


     if($validation->fails()) {
         Log::info($validation->getMessageBag()->first());

         return Redirect::back()->withErrors($validation->getMessageBag()->first())->withInput();
     }

 
     $product=Vproduct::where('productName',$request->productName)->first();
         if (!$product)          
         {
          
             
        $data = [
             'productName' =>$request->productName,
             'productPrice' =>$request->productPrice,
            //  'category_id' =>$request->category_id,
             'productDiscountPrice' => $request->productDiscountPrice,
             // 'productName' =>$request->type,
             'ProductCoupon' => 0,
             'ProductDiscription' => $request->ProductDiscription,
             
         ];
         $payment = Vproduct::firstOrCreate(['productName'=>$request->name],$data);

         $notify[] = ['success', ' Product Added successfully'];
         return redirect()->back()->withNotify($notify);

       
            # code...
        }
       else
       {
         return Redirect::back()->withErrors(array('Products already Exists! '));
       }

     }
    catch(\Exception $e){
     Log::info('error here');
     Log::info($e->getMessage());
     print_r($e->getMessage());
     die("hi");
     return  Redirect::back()->withErrors('error', $e->getMessage())->withInput();
     }


     }




    public function billingSubmitAdmin(Request $request)
    {

    try{
        $validation =  Validator::make($request->all(), [
            'product_id' => 'required',
            'cartTotal' => 'required|numeric',
            'grandTotal' => 'required',
            'DiscountTotal' => 'required',
            'CouponTotal' => 'required',
            'quantity' => 'required',
            'productPrice' => 'required',
            'username' => 'required',
            

        ]);


        if($validation->fails()) {
            Log::info($validation->getMessageBag()->first());

            return redirect()->route('admin.admin-product')->withErrors($validation->getMessageBag()->first())->withInput();
        }
    
        $product=Product::where('id',$request->product_id)->first();
            if ($product)          
            {
         
           $data = [
                'quantity' =>$request->quantity,
                'netAmount' =>$request->cartTotal,
                'grandTotal' => $request->grandTotal,
                'discount' => $request->DiscountTotal,
                'coupon' => $request->CouponTotal,
                'productPrice' => $request->productPrice,
                'product_id' => $request->product_id,
                'admin_id' => Auth::guard('admin')->user()->id,
                'activeStatus' =>1,
            ];
            $payment = Admin_product::create($data);
            $notify[] = ['success', ' Product Added successfully'];
            return redirect()->route('admin.admin-product')->withNotify($notify);
               # code...
           }
          else
          {
            return redirect()->route('admin.admin-product')->withErrors(array('Products not found! '));
          }

        }
       catch(\Exception $e){
        Log::info('error here');
        Log::info($e->getMessage());
        print_r($e->getMessage());
        die("hi");
        return  redirect()->route('admin.admin-product')->withErrors('error', $e->getMessage())->withInput();
        }



 }
 public function V_product()
 {

 
    $this->data['page'] = 'admin.products.admin.vendor_product';
     return $this->admin_dashboard(); 
 }

        
    public function a_Product(Request $request)
    {

    try{
        $validation =  Validator::make($request->all(), [
            'productName' => 'required',
            'productPrice' => 'required|numeric',
          
            'productDiscountPrice' => 'required',
           
            'ProductDiscription' => 'required',
            'icon_image'=>'max:4096|mimes:jpeg,png,jpg,svg,webp',

        ]);


        if($validation->fails()) {
            Log::info($validation->getMessageBag()->first());

            return Redirect::back()->withErrors($validation->getMessageBag()->first())->withInput();
        }

    
        $product=Vproduct::where('productName',$request->productName)->first();
            if (!$product)          
            {
                $icon_image = $request->file('icon_image');
                $imageName = time().'.'.$icon_image->extension();
                $request->icon_image->move(public_path('image/'),$imageName);
                
                
           $data = [
                'productName' =>$request->productName,
                'productPrice' =>$request->productPrice,
              
                'productDiscountPrice' => $request->productDiscountPrice,
                // 'productName' =>$request->type,
                'ProductCoupon' => 0,
                'ProductDiscription' => $request->ProductDiscription,
                 'image' => 'image/'.$imageName,
            ];
            $payment = Vproduct::firstOrCreate(['productName'=>$request->name],$data);

            $notify[] = ['success', ' Product Added successfully'];
            return redirect()->back()->withNotify($notify);

          
               # code...
           }
          else
          {
            return Redirect::back()->withErrors(array('Products already Exists! '));
          }

        }
       catch(\Exception $e){
        Log::info('error here');
        Log::info($e->getMessage());
        print_r($e->getMessage());
        die("hi");
        return  Redirect::back()->withErrors('error', $e->getMessage())->withInput();
        }


        }



        public function agent_product()
        {
       
        
           $this->data['page'] = 'admin.products.admin.agent_product';
            return $this->admin_dashboard(); 
        }


        public function Categorylist(Request $request)
        {
    
            $limit = $request->limit ? $request->limit : 100000000000;
            $status = $request->status ? $request->status : null;
            $search = $request->search ? $request->search : null;
            $notes = Category::orderBy('id', 'DESC');
    
            if($search <> null && $request->reset!="Reset")
            {
            $notes = $notes->where(function($q) use($search){
                $q->Where('id ', 'LIKE', '%' . $search . '%')          
                ->orWhere('categoryname', 'LIKE', '%' . $search . '%')
                ->orWhere('status', 'LIKE', '%' . $search . '%')
                ->orWhere('created_at', 'LIKE', '%' . $search . '%')         
                ->orWhere('	updated_at', 'LIKE', '%' . $search . '%');
              });
              }
            $notes = $notes->paginate($limit)
                ->appends([
                    'limit' => $limit
                ]);
    
            $this->data['product_list'] =  $notes;
            $this->data['search'] = $search;
           $this->data['page'] = 'admin.products.admin.Categorylist';
            return $this->admin_dashboard(); 
        }



        public function deletecategory(Request $request)
        {
    
           $id= $request->id ; // or any params
 
      
           $product = Categorie::where('id',$id)->delete();
           $notify[] = ['success', 'Product Edit successfully'];
         return redirect()->back()->withNotify($notify);
         
       
       
         
    
       }


       public function editcategory(Request $request)
       {
           try {
               // Validation rules
               $validation = Validator::make($request->all(), [
                   'id' => 'required|exists:categories,id',
                   'status' => 'required|in:0,1', // Ensures that status is either 0 or 1
               ]);
       
               if ($validation->fails()) {
                   Log::info($validation->getMessageBag()->first());
                   return Redirect::back()->withErrors($validation->getMessageBag()->first())->withInput();
               }
       
               $product = Categorie::find($request->id);
       
               if ($product) {
                   $data = [
                       'status' => $request->status,
                   ];
       
                   $product->update($data);
       
                   $notify[] = ['success', 'Category status updated successfully'];
                   return redirect()->back()->withNotify($notify);
               } else {
                   return Redirect::back()->withErrors(['Category does not exist!']);
               }
           } catch (\Exception $e) {
               Log::info('Error occurred');
               Log::info($e->getMessage());
               return Redirect::back()->withErrors(['error' => $e->getMessage()])->withInput();
           }
       }
       
      





      


    public function edit_category($id)
        {
    
        try {
            $id = Crypt::decrypt($id);
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return back()->withErrors(array('Invalid User!'));
        }
    
        $product = Categorie::where('id',$id)->first();
    
        $this->data['product'] =  $product;
        $this->data['page'] = 'admin.products.admin.categoryedit';
        return $this->admin_dashboard();
    
       }



       public function toggleStatus(Request $request)
       {
           $category = Categorie::find($request->cid);
           $category->status= $category->status == 0 ? 1 : 0;
           $category->save();
       
           $notify[] = ['success', 'Category status updated successfully'];
           return redirect()->back()->withNotify($notify);       }




           public function agent_report(Request $request)
           {
       
               $limit = $request->limit ? $request->limit : 100000000000;
               $status = $request->status ? $request->status : null;
               $search = $request->search ? $request->search : null;
               $notes = Seller_invoice::orderBy('id', 'DESC');
       
               if($search <> null && $request->reset!="Reset")
               {
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
              $this->data['page'] = 'admin.products.agent_report';
               return $this->admin_dashboard(); 
           }



           public function view_invoices($id)
           {
       
           try {
               $id = Crypt::decrypt($id);
               } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
               return back()->withErrors(array('Invalid User!'));
           }
       
            $investment = Seller_invoice::where('id',$id)->first();
            $admin=GeneralSetting::first();
       
           $this->data['investment'] =  $investment;
           $this->data['admin'] =  $admin;
       
           $this->data['page'] = 'admin.products.Invoices';
           return $this->dashboard_layout();
       
          }
       
          public function vendor_invoice_b($id)
          {
       
          try {
              $id = Crypt::decrypt($id);
              } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
              return back()->withErrors(array('Invalid User!'));
          }
       
          $investment =Investment::where('id',$id)->first();
    
    $admin=GeneralSetting::first();
       
          $this->data['investment'] =  $investment;
          $this->data['page'] = 'admin.products.seller.vendor-invoice';
          return $this->admin_dashboard();
       
         }

    }
      

