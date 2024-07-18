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
        <div class="container-fluid">
      <div class="page-content" style="overflow-x: auto">
          <div class="container-fluid" style="padding-left:10%">


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
<<<<<<< HEAD
                                    <div class="card-body">
                                        
=======
                                    <div class="card-body" style="
    border: black 1px dotted;
">
                            <div class="invoice-title" style="
    background: #f1b44c;
">
                                <center>
                                    <div class="mb-4" style="
    background: #f1b44c;
">
                                        <img src="http://127.0.0.1:8000/main/images/logo.png" alt="logo" height="80">
                                    </div>
                                </center>
                                <center>

                                    <h1 style="
    font-size: xxx-large;
    color: white;
    /* text-decoration: wavy; */
    /* font-variant: simplified; */
    /* font-size: -webkit-xxx-large; */
">
                                        <b> MENU</b>
                                    </h1>
                                </center>

                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <address>
                                        <strong>Customer's Detail:</strong><br>
                                        morsapprofitzone@gmail.com<br>
                                        9812340321<br>
                                        <strong>Billed To:</strong><br>
                                        Ramesh<br>
                                        Ram Nagar Panipat
                                    </address>
                                </div>
                                <div class="col-sm-6 text-sm-end">
                                    <address class="mt-2 mt-sm-0">
                                        <strong>Shipped To:</strong>

                                                    <br>
                                                    Ramesh<br>
                                                    Sec 13-17,Panipat<br>
                                                    9876543210<br>
                                                  
                                                </address>
                                            </div>
                                        </div>
>>>>>>> 1d1517cf28f8f413d5ab5a0dffb6bcd77bc7ac69
                                        <div class="row">
                                            <div class="col-sm-6 mt-3">
                                                <address>
                                                    <strong>Payment Method:</strong><br>
                                                    Cash<br>
<<<<<<< HEAD
                                                    {{$investment->email}}
=======
                                                    morsapprofitzone@gmail.com
>>>>>>> 1d1517cf28f8f413d5ab5a0dffb6bcd77bc7ac69
                                                </address>
                                            </div>
                                            <div class="col-sm-6 mt-3 text-sm-end">
                                                <address>
                                                    <strong>Order Date:</strong><br>
                                                    Fri, 05 Jul 2024<br><br>
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

<<<<<<< HEAD
                                                    <?php $cnt = 0; ?>

                                                    @php
                                                    $products = \App\Models\Seller_product::where('invest_id', $investment->id)->get();
                                                @endphp
                                                @foreach ($products as $value)
                                                    @php
                                                        $data = \App\Models\Product::find($value->product_id);
                                                    @endphp
                                                
=======
                                                                                                                                                    
                                                <tr>
                                                    <td>1</td>
                                                    <td>Cottage Cheese Feta Cannelloni</td>
                                                    <td>1 </td>
                                                    <td class="text-end">₹ 444</td>
                                                </tr>
                                                    
                                                                                                
                                                <tr>
                                                    <td>2</td>
                                                    <td>Classic Swiss Fondue</td>
                                                    <td>1 </td>
                                                    <td class="text-end">₹ 323</td>
                                                </tr>
                                                    
                                                
                                                   
                                                  
>>>>>>> 1d1517cf28f8f413d5ab5a0dffb6bcd77bc7ac69
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $data->productName }} - {{ $data->ProductDiscription }}</td>
                                                        <td>{{ $value->quantity }}</td>
                                                        {{-- <td class="text-end">&#8377; {{ $value->productPrice }}</td> --}}
                                                    </tr>
                                                @endforeach
                                                
                                                  
                                                    {{-- <tr>
                                                        <td colspan="3" class="text-end">Sub Total</td>
<<<<<<< HEAD
                                                        <td class="text-end">&#8377; {{$investment->grandTotal}}</td>
                                                    </tr> --}}
                                                    {{-- <tr>
                                                        <td colspan="3" class="border-0 text-end">
                                                            <strong>Discount</strong></td>
                                                        <td class="border-0 text-end">&#8377; {{$investment->discount}}</td>
                                                    </tr> --}}
=======
                                                        <td class="text-end">₹ 767</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" class="border-0 text-end">
                                                            <strong>Discount</strong></td>
                                                        <td class="border-0 text-end">₹ 767</td>
                                                    </tr>
>>>>>>> 1d1517cf28f8f413d5ab5a0dffb6bcd77bc7ac69

                                                 
                                                    <tr>
                                                        <td colspan="3" class="border-0 text-end">
<<<<<<< HEAD
                                                            <strong>Total Quantity</strong></td>
                                                        <td class="border-0 text-end"><h4 class="m-0"> {{$investment->grandTotal}}</h4></td>
=======
                                                            <strong>Total</strong></td>
                                                        <td class="border-0 text-end"><h4 class="m-0">₹ 0</h4></td>
>>>>>>> 1d1517cf28f8f413d5ab5a0dffb6bcd77bc7ac69
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="d-print-none">
                                            <div class="float-end">
                                                <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light me-1"><i class="fa fa-print"></i></a>
                                                <a href="http://127.0.0.1:8000/user/DepositHistory" class="btn btn-primary w-md waves-effect waves-light"><i class="fa fa-arrow-left"></i>Back</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
<<<<<<< HEAD
                        </div>
=======
                        </div>                        <!-- end row -->
>>>>>>> 1d1517cf28f8f413d5ab5a0dffb6bcd77bc7ac69


    </div>


    </div>

     
</div>
</div>
</div>
  </body>
</html>
