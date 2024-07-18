
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
                                    <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                            <li class="breadcrumb-item active">Dashboard</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-xl-4">
                                <div class="card overflow-hidden">
                                    <div class="bg-primary bg-soft">
                                        <div class="row">
                                            <div class="col-7">
                                                <div class="text-primary p-3">
                                                    <h5 class="text-primary">Welcome Back !</h5>
                                                    <p>{{siteName()}}</p>
                                                </div>
                                            </div>
                                            <div class="col-5 align-self-end">
                                                <img src="{{ asset('') }}assets/images/profile-img.png" alt="" class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="avatar-md profile-user-wid mb-4">
                                                    <img src="{{ asset('') }}assets/images/users/avatar-1.jpg" alt="" class="img-thumbnail rounded-circle">
                                                </div>
                                                <h5 class="font-size-15 text-truncate">{{Auth::user()->name}}</h5>
                                                <p class="text-muted mb-0 text-truncate"><div class="btn btn-primary waves-effect waves-light btn-sm" role="alert">{{(Auth::user()->rank)?"SELLER":"CUSTOMER"}}</div></p>
                                            </div>

                                            <div class="col-sm-8">
                                                <div class="pt-4">

                                                    <div class="row">
                                                        <div class="col-12">
                                                            <h5 class="font-size-15">{{(Auth::user()->role=="Agent")?"AGENT":"VENDOR"}} ID</h5>
                                                            <p class="text-muted mb-0">{{Auth::user()->username}}</p>
                                                        </div>
                                                       
                                                    </div>
                                                    <div class="mt-4">
                                                        <a href="javascript: void(0);" class="btn btn-primary waves-effect waves-light btn-sm">View Profile <i class="mdi mdi-arrow-right ms-1"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              
                            </div>
                        </div>
                        <!-- end row -->

                  
                        <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Enquiry Reports</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Buy Product</a></li>
                                <li class="breadcrumb-item active">Product Reports</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body" style="overflow-x: auto;">
                            <table id="datatable" class="table table-bordered  w-100">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                      
                                        <th>Customer Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>City</th>
                                        <th>Total Person</th>
                                        <th>Enquiry Date</th>
                                        <th>Agent Name</th>
                                        <th>Status of Enquiry</th>
                                        <th>Menu Generated Pdf</th>
                                        <th>Close</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(is_array($deposit_list) || is_object($deposit_list)){ ?>
                                        <?php $cnt = 0; ?>
                                        @foreach($deposit_list as $value)
                                            <tr>
                                                <td><?= $cnt += 1?></td>
                                              
                                                <td>{{ $value->name }}</td>
                                                <td>{{ $value->phone }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td>{{ $value->city }}</td>
                                                <td>{{ $value->total_people}}</td>
                                                <td>{{ $value->sdate }}</td>
                                                <td>{{ $value->user->name }}</td>
                                                <td>{{ $value->request_status }}</td>
                                                <td>
                                                    <a href="{{ route('user.view-invoice', ['id' => Crypt::encrypt($value->id)]) }}" class="btn btn-primary btn-sm btn-rounded">
                                                        View Details
                                                    </a>
                                                </td>
                                               
                                                <td>
                                                    <form action="{{ route('user.close-request', $value->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm btn-rounded">
                                                            Close
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
          
