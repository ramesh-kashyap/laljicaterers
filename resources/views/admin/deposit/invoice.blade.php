
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
                                                <th class="center">#</th>
                                                <th>Item</th>
                                                <th>Description</th>
                                               
                                                <th class="center">Qty</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            <?php $cnt = 0; ?>
                                            @php
                                            $products = \App\Models\Seller_product::where('invest_id', $investment->id)->get();
                                        @endphp
                                              @foreach ($products as $value)
                                              @php
                                                  $data = \App\Models\Product::find($value->product_id);
                                              @endphp

                                            <tr>
                                                <td  class="center"><?= $cnt += 1?></td>
                                                <td class="left strong">{{ $data->productName }} </td>
                                                <td class="left">{{ $data->ProductDiscription }}</td>
                                                <td class="center">{{$value->quantity}} </td>
                                            </tr>
                                                
                                            @endforeach


                                            
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-sm-5"> </div>
                                    <div class="col-lg-4 col-sm-5 ms-auto">
                                        <table class="table table-clear">
                                            <tbody>
                                                
                                               
                                                <tr>
                                                    <td class="left"><strong>Total Quantity</strong></td>
                                                    <td class="right"><strong> {{$investment->grandTotal}}</strong><br>
                                                     
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
