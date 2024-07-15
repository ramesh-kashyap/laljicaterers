    <!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="" xml:lang="">
  <head>
    <title>
      static/downloads/b2099d9d-d5aa-4190-bc2d-22ba04d480d1/lalji-catererss-menu-html.html
    </title>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <br />
    <style type="text/css">
      <!--
      	p {margin: 0; padding: 0;}	.ft10{font-size:24px;font-family:AAAAAA+Inter;color:#000000;}
      	.ft11{font-size:23px;font-family:BAAAAA+Forum;color:#000000;}
      	.ft12{font-size:25px;font-family:BAAAAA+Forum;color:#000000;}
      	.ft13{font-size:15px;line-height:36px;font-family:BAAAAA+Forum;color:#000000;}
      -->
    </style>
  </head>
  <body bgcolor="#A0A0A0" vlink="blue" link="blue">
    <div class="main-content">

      <div class="page-content">
          <div class="container-fluid" style="padding-left:15%">


    <div
      id="page1-div"
      style="position: relative; width: 1188px; height: 1835px"
    >
      <img
        width="1188"
        height="1835"
        src="/image/bill.png"
        alt="background image"
      />
      <p
        style="position: absolute; top: 253px; left: 460px; white-space: nowrap"
        class="ft10"
      >
        <b>LALJI&#160;CATERERS’S</b>
      </p>
      <p
        style="
          position: absolute;
          top: 1734px;
          left: 389px;
          white-space: nowrap;
        "
        class="ft11"
      >
        ADDRESS:&#160;GMC&#160;COLLEGE&#160;YAMUNA&#160;SANKUL,&#160;NEW
      </p>
      <p
        style="
          position: absolute;
          top: 1767px;
          left: 377px;
          white-space: nowrap;
        "
        class="ft11"
      >
        RADHAKISAN&#160;PLOTS,&#160;AKOLA,&#160;MAHARASHTRA&#160;444001
      </p>
      <p
        style="position: absolute; top: 457px; left: 102px; white-space: nowrap"
        class="ft13"
      >
        <strong>CUSTOMER&#160;NAME&#160;:</strong> {{$investment->name}}<br /><strong>ADDRESS&#160;:</strong>{{$investment->address}}<br /><strong>CONTACT&#160;NUMBER&#160;:</strong>{{$investment->address}}<br /><strong>EVENT&#160;DATE&#160;:</strong>{{$investment->created_at}}<br /><strong>ATTENDED&#160;BY&#160;AGENT&#160;:</strong>{{Auth::user()->name}}
      </p>

      <div class="row "  style="position: absolute;top: 658px;left: 44px;white-space: nowrap;width: 95%;">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        
                                        <div class="row">
                                            <div class="col-sm-6 mt-3">
                                                <address>
                                                    <strong>Payment Method:</strong><br>
                                                    Cash<br>
                                                    {{$investment->email}}
                                                </address>
                                            </div>
                                            <div class="col-sm-6 mt-3 text-sm-end">
                                                <address>
                                                    <strong>Order Date:</strong><br>
                                                    {{date("D, d M Y", strtotime($investment->sdate))}}<br><br>
                                                </address>
                                            </div>
                                        </div>

                                      
                                        <div class="py-2 mt-3">
                                            <h3 class="font-size-15 fw-bold">Order summary</h3>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 70px;">No.</th>
                                                        <th>Item</th>
                                                        <th>Quantity</th>
                                                        {{-- <th class="text-end">Price</th> --}}
                                                   
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
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $data->productName }} - {{ $data->ProductDiscription }}</td>
                                                        <td>{{ $value->quantity }}</td>
                                                        {{-- <td class="text-end">&#8377; {{ $value->productPrice }}</td> --}}
                                                    </tr>
                                                @endforeach
                                                
                                                  
                                                    {{-- <tr>
                                                        <td colspan="3" class="text-end">Sub Total</td>
                                                        <td class="text-end">&#8377; {{$investment->grandTotal}}</td>
                                                    </tr> --}}
                                                    {{-- <tr>
                                                        <td colspan="3" class="border-0 text-end">
                                                            <strong>Discount</strong></td>
                                                        <td class="border-0 text-end">&#8377; {{$investment->discount}}</td>
                                                    </tr> --}}

                                                 
                                                    <tr>
                                                        <td colspan="3" class="border-0 text-end">
                                                            <strong>Total Quantity</strong></td>
                                                        <td class="border-0 text-end"><h4 class="m-0"> {{$investment->grandTotal}}</h4></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="d-print-none">
                                            <div class="float-end">
                                                <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light me-1"><i class="fa fa-print"></i></a>
                                                <a href="{{route('user.DepositHistory')}}" class="btn btn-primary w-md waves-effect waves-light"><i class="fa fa-arrow-left"></i>Back</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


    </div>


    </div>

     
</div>
</div>
</div>
  </body>
</html>
