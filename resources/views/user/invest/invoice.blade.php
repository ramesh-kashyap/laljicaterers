
<style>
        @media print {
            .invoice-title, .invoice-title .mb-4 {
                background: #f1b44c !important;
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

              <div class="page-content">
                  <div class="container-fluid">

                      <!-- start page title -->
                      <div class="row">
                          <div class="col-12">
                              <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                  <h4 class="mb-sm-0 font-size-18">Detail</h4>

                                  <div class="page-title-right">
                                      <ol class="breadcrumb m-0">
                                          <li class="breadcrumb-item"><a href="javascript: void(0);">Invoices</a></li>
                                          <li class="breadcrumb-item active">Detail</li>
                                      </ol>
                                  </div>

                              </div>
                          </div>
                      </div>
                      <!-- end page title -->

                      <div class="row">
                          <div class="col-lg-12">
                              <div class="card">
                                  <div class="card-body">
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
    / text-decoration: wavy; /
    / font-variant: simplified; /
    / font-size: -webkit-xxx-large; /
">
                                        <b> MENU</b>
                                    </h1>
                                </center>

                            </div>
                                      <hr>
                                      <div class="row">
                                          <div class="col-sm-6">
                                              <address>
                                                  <strong>Customer's:</strong><br>
                                                  {{$investment->email}}<br>
                                                  {{$investment->phone}}<br>
                                             
                                                  <strong>Billed To:</strong><br>
                                                 
                                                  {{$investment->name}}<br>
                                                  {{$investment->address}}<br>
                                                  {{$investment->email}}<br>
                                                  {{$investment->phone}}<br>
                                              </address>
                                          </div>
                                          <div class="col-sm-6 text-sm-end">
                                              <address class="mt-2 mt-sm-0">
                                                  <strong>Shipped To:</strong>

                                                  <br>
                                                 
                                                  {{$admin->name}}<br>
                                                  {{$admin->phone}}<br>
                                                  {{$admin->address}}
                                               
                                              </address>
                                          </div>
                                      </div>
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
                      <!-- end row -->

                  </div> <!-- container-fluid -->
              </div>
              <!-- End Page-content -->
              