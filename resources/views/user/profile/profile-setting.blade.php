

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
                                <h4 class="mb-sm-0 font-size-18">Edit Profile</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Profile</a></li>
                                        <li class="breadcrumb-item active">Edit Profile</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                     @php 
                              $name = Auth::user()->role=="Vendor"? "Vendor" : "Agent";
                     @endphp

                  
                    <!-- end row -->
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-body">
                                  

                                    <form class="custom-validation" action="{{ route('user.update-profile') }}" method="POST" >
                                       

                                        {{ csrf_field() }}

                                        <!-- <div class="mb-3">
                                            <label class="form-label">Sponsor ID</label>
                                            <div>
                                                <input class="form-control" type="text" name=""
                                                value="{{ $profile_data->sponsor_detail ? $profile_data->sponsor_detail->username : '0' }}"
                                                readonly>
                                            </div>
                                        </div> -->
                                        <div class="mb-3">
                                            <label class="form-label">{{$name}} ID</label>
                                            <div>
                                                <input class="form-control" type="text" name="memberID"
                                                value="{{ $profile_data ? $profile_data->username : '' }}" readonly>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">{{$name}} Name</label>
                                            <div>
                                                <input class="form-control" type="text" id="firstName" name="name"
                                                    value="{{ $profile_data ? $profile_data->name : '0' }}" autofocus />
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">{{$name}} Email ID</label>
                                            <div>
                                                <input class="form-control" type="email" name="email"
                                                value="{{ $profile_data ? $profile_data->email : '' }}" placeholder="Email ID" />
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">{{$name}} Mobile No</label>
                                            <div>
                                                <input type="text" value="{{($profile_data)?$profile_data->phone:''}}" id="phoneNumber" name="phone" class="form-control"
                                                placeholder="202 555 0111" />
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">{{$name}} Address</label>
                                            <div>
                                                <input type="text" value="{{($profile_data)?$profile_data->address:''}}"  name="address" class="form-control"
                                                placeholder="{{$name}} Address" />
                                            </div>
                                        </div>

                                      
                                        <div class="d-flex flex-wrap gap-2">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                Submit
                                            </button>
                                            <button type="reset" class="btn btn-secondary waves-effect">
                                                Cancel
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div> <!-- end col -->

                        


                        

            
                    </div> <!-- end row -->

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
