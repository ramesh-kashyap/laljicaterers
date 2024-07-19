<center>
<style>h1 {
  display: block;
  font-size: 5em;

  margin-left: 0;
 
}</style>
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <!-- <div class="row page-titles">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Layout</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Blank</a></li>
                    </ol>
                </div> -->
                <div class="row" style="border: 3px dotted black;
">
                    <div class="col-lg-12">

                        <div class="card mt-3">
                            <div class="card-header" style="background:#ffa41d;color:#ffa41d;"> Invoice <strong>   <div class="brand-logo mb-3">
                                                    <img class="logo-abbr me-2" width="10"
                                                        src="{{asset('main/images/logo.png')}}" alt="" style="width:170px; height:120px;">
                                                  
                                                </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h1 style="color:white;">MENU</h1></strong>  <span class="float-end">


                                               
                                    <strong>Status:</strong> <span style="color: green;font-weight:800"></span> </div>
                            <div class="card-body">
                                <div class="row mb-5">
                                    <div class="mt-4 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                        <h6>From:</h6>
                                        @php
                                        $admin=\App\Models\GeneralSetting::first();
                                        @endphp
                                        <div> <strong>{{ $admin->name }}</strong> </div>
                                        <div>{{ $admin->address }}</div>
                                        <div>Email: {{ $admin->email_from }}</div>
                                        <div>Phone: {{ $admin->phone }}</div>
                                    </div>
                                    <div class="mt-4 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                        <h6>To:</h6>
                                        <div> <strong> {{$investment->name}}</strong> </div>
                                        <div> {{$investment->address}}</div>
                                      
                                        <div>Email:  {{$investment->email}}</div>
                                        <div>Phone:  {{$investment->phone}}</div>
                                    </div>
                                    <div
                                        class="mt-4 col-xl-6 col-lg-6 col-md-12 col-sm-12 d-flex justify-content-lg-end justify-content-md-center justify-content-xs-start">
                                        <div class="row align-items-center">
                                            <div class="col-sm-9">
                                                <!-- <div class="brand-logo mb-3">
                                                    <img class="logo-abbr me-2" width="10"
                                                        src="{{asset('main/images/logo.png')}}" alt="" style="width:90px">
                                                   -->
                                                </div>
                                                <br>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 70px;">No.</th>
                                            <th>Item</th>
                                            <th>Quantity</th>
                                            <th class="text-end">Price</th>
                                        </tr>
                                        </thead>
                                        <tbody>


                                        @php
                                        $cnt = 0;
                                        $subTotal = 0;
                                        $discountTotal = 0;
                                        $products = \App\Models\User_product::where('invest_id',
                                        $investment->id)->get();
                                        @endphp

                                        @foreach ($products as $value)
                                        @php
                                        $data = \App\Models\Vproduct::find($value->product_id);
                                        $productTotal = $data->productPrice * $value->quantity;
                                        $productDiscount = ($data->productPrice - $data->productDiscountPrice) *
                                        $value->quantity;
                                        $subTotal += $productTotal;
                                        $discountTotal += $productDiscount;
                                        @endphp

                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->productName }} - {{ $data->ProductDiscription }}</td>
                                            <td>{{ $value->quantity }}</td>
                                            <td class="text-end">&#8377; {{ $productTotal }}</td>
                                        </tr>
                                        @endforeach

                                        @php
                                        $total = $subTotal - $discountTotal;
                                        @endphp

                                        <tr>
                                            <td colspan="3" class="text-end">Sub Total</td>
                                            <td class="text-end">&#8377; {{ $subTotal }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="border-0 text-end"><strong>Discount</strong></td>
                                            <td class="border-0 text-end">&#8377; {{ $discountTotal }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="border-0 text-end"><strong>Total</strong></td>
                                            <td class="border-0 text-end">
                                                <h4 class="m-0">&#8377; {{ $total }}</h4>
                                            </td>
                                        </tr>
                                    </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-sm-5"> </div>
                                    <div class="col-lg-4 col-sm-5 ms-auto">
                                        
                                        
                                    </div>

                                    <div class="d-print-none">
                                <div class="float-end">
                                    <button onclick="printInvoice()" class="btn btn-success waves-effect waves-light me-1">
                                        <i class="fa fa-print"></i> Print
                                    </button>
                                    <a href="{{route('user.DepositHistory')}}" class="btn btn-primary w-md waves-effect waves-light">
                                        <i class="fa fa-arrow-left"></i> Back
                                    </a>
                                </div>
                            </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>

@media print {
            .invoice-title, .invoice-title .mb-4 ,.card-header{
                background: #f1b44c !important;
                -webkit-print-color-adjust: exact;
            }
        }

@media print {
    
    .footer,.nav-header,.page-title-box,.right-bar,.vertical-menu,.deznav,.header{
                                    display: none!important
                                }

                                .content-body,.card-body,.main-content,.page-content,.right-bar,body {
                                    padding: 0;
                                    margin: 0
                                }

                                .content-body{
                                    padding: 0;
                                    margin: -180px 0px 0px 0px !important;
                                }

                                .card {
                                    border: 0
    }
   
}
</style>
<script>
function printInvoice() {
    window.print();
}
</script>


        <!--**********************************
            Content body end
        ***********************************-->
