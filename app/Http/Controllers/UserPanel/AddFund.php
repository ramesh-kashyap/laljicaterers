<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BuyFund;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Models\Product;
use App\Models\Vproduct;
use App\Models\Category;
use App\Models\Seller_product;
use App\Models\Vendor_product;
use App\Models\Investment;
use App\Models\Admin_product;
use App\Models\Seller_invoice;
use App\Models\VendorBilling;
use App\Models\User_product;
use App\Models\GeneralSetting;
use Log;
use Redirect;
class AddFund extends Controller
{
    public function index(Request $request)
    {
    
    $user=Auth::user();
     \DB::statement("SET SQL_MODE=''");
    $product = Vproduct::orderBy('id','DESC')->get();

    $this->data['product'] = $product;
    $this->data['page'] = 'user.fund.addFund';
    return $this->dashboard_layout();
    
    }


public function fundHistory(Request $request)
{

   
    $user=Auth::user();
    $limit = $request->limit ? $request->limit : paginationLimit();
    $status = $request->status ? $request->status : null;
    $search = $request->search ? $request->search : null;
    $notes = Investment::where('user_id', $user->id)->where('status', 'Active')->orderBy('id', 'DESC');
    if($search <> null && $request->reset!="Reset"){
    $notes = $notes->where(function($q) use($search){
        $q->Where('product_id', 'LIKE', '%' . $search . '%')
     
        ->orWhere('activeStatus', 'LIKE', '%' . $search . '%');
    });

    }

    $notes = $notes->paginate($limit)
        ->appends([
            'limit' => $limit
        ]);

    $this->data['search'] =$search;
    $this->data['level_income'] =$notes;
    $this->data['page'] = 'user.fund.fundHistory';
    return $this->dashboard_layout();

}



public function add_cart(Request $request)
{

  try{
        $validation =  Validator::make($request->all(), [
            'products' => 'required',
            'user_id' => 'required|exists:users,username',
            
        ]);

        if($validation->fails()) {
            Log::info($validation->getMessageBag()->first());

            return redirect()->route('user.AddFund')->withErrors($validation->getMessageBag()->first())->withInput();
        }

        $user=Auth::user();

            if (empty($request->products))
                {
                return Redirect::back()->withErrors(array('Something went wrong'));
                }
        

        $product = Vproduct::whereIn('id',$request->products)->get();
        dd($product);
   
        $this->data['product'] = $product;
        $this->data['user_id'] = $request->user_id;
        $this->data['page'] = 'user.fund.add_cart';
        return $this->dashboard_layout();


    
      }
       catch(\Exception $e){
        Log::info('error here');
        Log::info($e->getMessage());
        print_r($e->getMessage());
        die("hi");
        return  redirect()->route('user.AddFund')->withErrors('error', $e->getMessage())->withInput();
    }

}

public function fundActivation(Request $request)
{
    try {
        // Validate request
        $validation = Validator::make($request->all(), [
            'products' => 'required|array',
            'quantity' => 'required|array',
            'cartTotal' => 'required|numeric',
            'grandTotal' => 'required|numeric',
            'DiscountTotal' => 'required|numeric',
            'CouponTotal' => 'required|numeric',
            'payment_method' => 'required|string', // Add validation for payment_mode
        ]);

        if ($validation->fails()) {
            Log::info($validation->getMessageBag()->first());
            return redirect()->route('user.vendor_cards')->withErrors($validation->getMessageBag()->first())->withInput();
        }

        $user_detail = Auth::user();
        $products = $request->products;
        $quantities = $request->input('quantity', []);
        $cartTotal = $request->input('cartTotal');
        $mode = $request->payment_method;
        $grandTotal = $request->input('grandTotal');
        $DiscountTotal = $request->input('DiscountTotal');
        $CouponTotal = $request->input('CouponTotal');

        if (empty($products)) {
            return redirect()->route('user.vendor_cards')->withErrors(['cart is empty']);
        }

        // Insert investment data
        $invoice = substr(str_shuffle("0123456789"), 0, 7);
        $investmentData = [
            'plan' => $invoice,
            'transaction_id' => md5(uniqid(rand(), true)),
            'user_id' => $user_detail->id,
            'user_id_fk' => $user_detail->username,
            'amount' => $cartTotal,
            'payment_mode' => $mode, // Include payment_mode here
            'status' => 'Pending',
            'sdate' => date("Y-m-d"),
            'active_from' => $user_detail->username,
            'grandTotal' => $grandTotal,
            'discount' => $DiscountTotal,
            'coupon' => $CouponTotal,
        ];
        $paymentId = Investment::insertGetId($investmentData);

        // Insert product data
        foreach ($products as $key => $productId) {
            $productReport = Vproduct::where('id', $productId)->first();
            $quantity = $quantities[$key] ?? 1;

            $insertProduct = [
                'user_id' => $user_detail->id,
                'product_id' => $productId,
                'quantity' => $quantity,
                'productPrice' => $productReport->productPrice,
                'grandTotal' => $productReport->productPrice * $quantity,
                'discount' => ($productReport->productPrice * $quantity) - ($productReport->productDiscountPrice * $quantity),
                'netAmount' => $productReport->productDiscountPrice * $quantity,
                'activeStatus' => 0,
                'invest_id' => $paymentId,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            Vendor_product::create($insertProduct);
        }

        $notify[] = ['success', 'Product Request Submitted successfully'];
        return redirect()->route('user.vendor_cards')->withNotify($notify);
    } catch (\Exception $e) {
        Log::info('error here');
        Log::info($e->getMessage());
        return redirect()->route('user.vendor_cards')->withErrors(['error' => $e->getMessage()])->withInput();
    }
}


public function sellerBilling(Request $request)
{
    try {
        // Validate request
        $validation = Validator::make($request->all(), [
            'products' => 'required|array',
            'quantity' => 'required|array',
            'name' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|string',
            'city' => 'required|string',
            'event' => 'required|string',
            'no_dinner' => 'required',
            'no_lunch' => 'required',
            'no_breakfast' => 'required',
            'total_people' => 'required',
            'event_date' => 'required',
            'payment_mode' => 'required', // Added validation for payment_mode
        ]);

        if ($validation->fails()) {
            Log::info($validation->getMessageBag()->first());
            return redirect()->route('user.categories_menu')->withErrors($validation->getMessageBag()->first())->withInput();
        }

        $user_detail = Auth::user();
        $products = $request->products;
        $quantities = $request->input('quantity', []);
        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $no_dinner = $request->input('no_dinner');
        $no_breakfast = $request->input('no_breakfast');
        $no_lunch = $request->input('no_lunch');
        $total_people = $request->input('total_people');
        $additional_enquiry = $request->input('additional_enquiry');
        $event_date = $request->input('event_date');

        $event = $request->input('event');
        $city = $request->input('city');
        $payment_mode = $request->input('payment_mode'); // Retrieve payment_mode from request

        if (empty($products)) {
            return redirect()->route('user.categories_menu')->withErrors(['cart is empty']);
        }

        // Calculate total quantity
        $totalQuantity = array_sum($quantities);

        // Insert invoice data
        $invoiceNumber = substr(str_shuffle("0123456789"), 0, 7);
        $invoiceData = [
            'plan' => $invoiceNumber,
            'transaction_id' => md5(uniqid(rand(), true)),
            'user_id' => $user_detail->id,
            'user_id_fk' => $user_detail->username,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'city' => $city,
            'no_dinner' => $no_dinner,
            'no_breakfast' => $no_breakfast,
            'no_lunch' => $no_lunch,
            'total_people' => $total_people,
            'additional_enquiry' => $additional_enquiry,
            'event_date' => $event_date,


            'event' => $event,
            'grandTotal' => $totalQuantity,
            'status' => 'Pending',
            'created_at' => now(),
            'updated_at' => now(),
            'mode' => $payment_mode, // Add payment_mode to invoice data
        ];
        $invoiceId = Seller_invoice::insertGetId($invoiceData);

        // Insert product data
        foreach ($products as $key => $productId) {
            $quantity = $quantities[$key] ?? 1;

            $insertProduct = [
                'user_id' => $user_detail->id,
                'product_id' => $productId,
                'quantity' => $quantity,
                'active_status' => 0,
                'invest_id' => $invoiceId,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            Seller_product::create($insertProduct);
        }

        $notify[] = ['success', 'Product Request Submitted successfully'];
        return redirect()->route('user.categories_menu')->withNotify($notify);
    } catch (\Exception $e) {
        Log::info('error here');
        Log::info($e->getMessage());
        return redirect()->route('user.Addagent')->withErrors(['error' => $e->getMessage()])->withInput();
    }
}
public function vendorBilling(Request $request)
{
    try {
        // Validate request
        $validation = Validator::make($request->all(), [
            'products' => 'required|array',
            'quantity' => 'required|array',
            'name' => 'required',
            'email' => 'required|string|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'payment_mode' => 'required|string',
            'no_breakfast' => 'required',
            'no_lunch' => 'required',
            'no_dinner' => 'required',
            'event_date' => 'required',
            'total_people' => 'required',
        ]);

        if ($validation->fails()) {
            Log::info($validation->getMessageBag()->first());
            return redirect()->route('user.buy_products')->withErrors($validation->getMessageBag()->first())->withInput();
        }

        $user_detail = Auth::user();
        $products = $request->input('products');
        $quantities = $request->input('quantity', []);
        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $no_lunch = $request->input('no_lunch');
        $no_breakfast = $request->input('no_breakfast');
        $no_dinner = $request->input('no_dinner');
        $event_date = $request->input('event_date');
        $total_people = $request->input('total_people');
        $additional_inquiry = $request->input('additional_inquiry');





        $address = $request->input('address');
        $payment_mode = $request->input('payment_mode');

        if (empty($products)) {
            return redirect()->route('user.buy_products')->withErrors(['cart is empty']);
        }

        // Calculate total quantity
        $totalQuantity = array_sum($quantities);

        // Insert invoice data
        $invoiceNumber = substr(str_shuffle("0123456789"), 0, 7);
        $invoiceData = [
            'plan' => $invoiceNumber,
            'transaction_id' => md5(uniqid(rand(), true)),
            'user_id' => $user_detail->id,
            'user_id_fk' => $user_detail->username,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'no_lunch' => $no_lunch,
            'no_breakfast' => $no_breakfast,
            'no_dinner' => $no_dinner,
            'event_date' => $event_date,
            'additional_inquiry' => $additional_inquiry,
            'grandTotal' => $totalQuantity,
            'status' => 'Pending',
            'created_at' => now(),
            'updated_at' => now(),
            'mode' => $payment_mode,
        ];
        $invoiceId = VendorBilling::insertGetId($invoiceData);

        // Insert product data
        foreach ($products as $key => $productId) {
            $quantity = $quantities[$key] ?? 1;

            $insertProduct = [
                'user_id' => $user_detail->id,
                'product_id' => $productId,
                'quantity' => $quantity,
                'active_status' => 0,
                'invest_id' => $invoiceId,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            User_product::create($insertProduct);
        }

        $notify[] = ['success', 'Product Request Submitted successfully'];
        return redirect()->route('user.buy_products')->withNotify($notify);
    } catch (\Exception $e) {
        Log::info('error here');
        Log::info($e->getMessage());
        return redirect()->route('user.buy_products')->withErrors(['error' => $e->getMessage()])->withInput();
    }
}


public function SubmitBuyFund(Request $request)
{

  try{
        $validation =  Validator::make($request->all(), [
            'products' => 'required',      
        ]);

        if($validation->fails()) {
            Log::info($validation->getMessageBag()->first());

            return redirect()->route('user.AddFund')->withErrors($validation->getMessageBag()->first())->withInput();
        }

        $user_detail=Auth::user();

        $products = $request->products;
      
        
        if (empty($products)) 
        {
         return redirect()->route('user.AddFund')->withErrors(array('cart is empty'));
        }
        
            foreach ($products as $key => $value) 
            {                   
            $productReport= Vproduct::where('id',$value)->first();
            $insertProduct['user_id']=$user_detail->id;
    
            $insertProduct['product_id']=$value; 
            $insertProduct['activeStatus']=0;
            Seller_product::create($insertProduct);  
            }

        $notify[] = ['success', 'Product Request Submited successfully'];
        return redirect()->route('user.AddFund')->withNotify($notify);

    
      }
       catch(\Exception $e){
        Log::info('error here');
        Log::info($e->getMessage());
        print_r($e->getMessage());
        die("hi");
        return  redirect()->route('user.AddFund')->withErrors('error', $e->getMessage())->withInput();
    }

}

public function ecommerce_cart(Request $request)
{
    try {
        $validation = Validator::make($request->all(), [
            'products' => 'required|array',
            'products.*' => 'exists:vproducts,id',
            'user_id' => 'required|exists:users,username',
            'payment_mode' => 'required|string'
        ]);

        if ($validation->fails()) {
            Log::info($validation->getMessageBag()->first());

            return redirect()->route('user.AddFund')->withErrors($validation->getMessageBag()->first())->withInput();
        }

        $user = Auth::user();

        if (empty($request->products)) {
            return Redirect::back()->withErrors(array('Something went wrong'));
        }

        $product = Vproduct::whereIn('id', $request->products)->get();

        $this->data['product'] = $product;
        $this->data['user_id'] = $request->user_id;
        $this->data['payment_mode'] = $request->payment_mode;
        $this->data['page'] = 'user.fund.ecommerce_cart';
        return $this->dashboard_layout();

    } catch (\Exception $e) {
        Log::info('error here');
        Log::info($e->getMessage());
        print_r($e->getMessage());
        die("hi");
        return redirect()->route('user.AddFund')->withErrors('error', $e->getMessage())->withInput();
    }
}

public function vendorCart(Request $request)
{
    try {
        $validation = Validator::make($request->all(), [
            'products' => 'required|array',
            
        ]);


        if ($validation->fails()) {
            Log::info($validation->getMessageBag()->first());

            return Redirect::back()->withErrors($validation->getMessageBag()->first())->withInput();
        }

        $user = Auth::user();

        if (empty($request->products)) {
            return Redirect::back()->withErrors(array('Something went wrong'));
        }

        $product = Vproduct::whereIn('id', $request->products)->get();

        $this->data['product'] = $product;
        $this->data['user_id'] = $request->user_id;
        $this->data['page'] = 'user.fund.ecommerce_cart';
        return $this->dashboard_layout();

    } catch (\Exception $e) {
        Log::info('error here');
        Log::info($e->getMessage());
        print_r($e->getMessage());
        die("hi");
        return Redirect::back()->withErrors('error', $e->getMessage())->withInput();
    }
}

    public function seller_cart(Request $request)
{
    try {
        // Validate request
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'categories' => 'required|array',
            'products' => 'required|array',
            'payment_mode' => 'required|string|in:cash,online',
        ]);

        if ($validation->fails()) {
            return redirect()->route('user.Addagent')->withErrors($validation->getMessageBag()->first())->withInput();
        }

        $user = Auth::user();

        if (empty($request->products)) {
            return redirect()->back()->withErrors(['Something went wrong']);
        }

        $products = Product::whereIn('id', $request->products)->get();

        $this->data['products'] = $products;
        $this->data['name'] = $request->name;
        $this->data['phone'] = $request->phone;
        $this->data['email'] = $request->email;
        $this->data['address'] = $request->address;
        $this->data['categories'] = $request->categories;
        $this->data['user_id'] = $request->user_id;
        $this->data['payment_mode'] = $request->payment_mode;
        $this->data['page'] = 'user.fund.sellercart';
        return $this->dashboard_layout();
        
    } catch (\Exception $e) {
        Log::error('Error in agent activation: ' . $e->getMessage());
        return redirect()->route('user.Addagent')->withErrors(['error' => $e->getMessage()])->withInput();
    }
}


public function seller_cart2(Request $request)
{
    try {
        // Validate request
        $validation = Validator::make($request->all(), [
            
            'products' => 'required|array',
          
        ]);

        if ($validation->fails()) {
            return redirect()->route('user.categories_menu')->withErrors($validation->getMessageBag()->first())->withInput();
        }
      
        

        $user = Auth::user();

        if (empty($request->products)) {
            return redirect()->back()->withErrors(['Please Select a Product']);
        }

        $products = Product::whereIn('id', $request->products)->get();

        $this->data['products'] = $products;
        $this->data['name'] = $request->name;
        $this->data['phone'] = $request->phone;
        $this->data['email'] = $request->email;
        $this->data['address'] = $request->address;
        $this->data['categories'] = $request->categories;
        $this->data['user_id'] = $request->user_id;
        $this->data['payment_mode'] = $request->payment_mode;
        $this->data['page'] = 'user.fund.sellercart';
        return $this->dashboard_layout();
        
    } catch (\Exception $e) {
        Log::error('Error in agent activation: ' . $e->getMessage());
        return redirect()->route('user.Addagent')->withErrors(['error' => $e->getMessage()])->withInput();
    }
}

    public function ViewSellerInvoice($id)
    {

    try {
        $id = Crypt::decrypt($id);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
        return back()->withErrors(array('Invalid User!'));
    }

    $investment = Seller_invoice::where('id',$id)->first();

    $this->data['investment'] =  $investment;
    $this->data['page'] = 'user.fund.view-invoice';
    return $this->dashboard_layout();

    }




public function sellerInvoice(Request $request){

    $user=Auth::user();
      $limit = $request->limit ? $request->limit : paginationLimit();
        $status = $request->status ? $request->status : null;
        $search = $request->search ? $request->search : null;
        $notes = Seller_invoice::where('user_id',$user->id);
        
      if($search <> null && $request->reset!="Reset"){
        $notes = $notes->where(function($q) use($search){
          $q->Where('user_id_fk', 'LIKE', '%' . $search . '%')
          ->orWhere('txn_no', 'LIKE', '%' . $search . '%')
          ->orWhere('status', 'LIKE', '%' . $search . '%')
          ->orWhere('type', 'LIKE', '%' . $search . '%')
          ->orWhere('amount', 'LIKE', '%' . $search . '%');
        });

      }

        $notes = $notes->paginate($limit)->appends(['limit' => $limit ]);

      $this->data['search'] =$search;
      $this->data['deposit_list'] =$notes;
      $this->data['page'] = 'user.fund.my-invoice';
      return $this->dashboard_layout();


        }

        public function agentindex(Request $request)
    {
    
    $user=Auth::user();
     \DB::statement("SET SQL_MODE=''");
    //  by category
    $categoryname = Category::orderBy('id','DESC')->get();
    $this->data['categoryname'] = $categoryname;
    // by product
    // $product = product::orderBy('category_id','DESC')->get();
    // $this->data['product'] = $product; 

    $this->data['page'] = 'user.agentselect.agentFund';
    return $this->dashboard_layout();   
    
    }
    

    
    public function getProductsByCategory(Request $request)
{
    $categoryIds = $request->input('categoryIds');
    $categoryIdsArray = explode(',', $categoryIds);
    $products = Product::whereIn('category_id', $categoryIdsArray)->get();

    return response()->json($products);
}

    public function agentActivation(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required',
        'address' => 'required',
    ]);

    $user_id = Auth::id();
    $name = $request->input('name');
    $email = $request->input('email');
    $address = $request->input('address');

    
        Seller_Invoice::create([
            'user_id' => $user_id,
            'activeStatus' => 0, // Default to pending
            'name' => $name,
            'email' => $email,
            'address' => $address,
            'product_id' =>$request->product_id,
            'category_id' =>$request->category_id, 
        ]);
    

    return redirect()->route('user.invest')->with('success', 'Order placed successfully.');
}
    

public function fetchProducts(Request $request)
{
    $categories = $request->categories;
    
    $products = Product::whereIn('category_id', $categories)->get(['id', 'productName as name']); // Adjust column names as per your table structure

    return response()->json(['products' => $products]);
}


public function invoices_details($id)
{

try {
    
    $investment = Investment::where('id',$id)->first();
    $invest_id=$investment->id;

    $products=Vendor_product::where('invest_id',$invest_id)->get();

    $admin=GeneralSetting::first();

    $this->data['investment'] =  $investment;
    $this->data['admin'] =  $admin;
$this->data['products'] =  $products;
// $this->data['vproduct'] =  $vproduct;

$this->data['page'] = 'user.fund.invoices_details';
return $this->dashboard_layout();



    } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
    return back()->withErrors(array('Invalid User!'));
}

 

}


}
