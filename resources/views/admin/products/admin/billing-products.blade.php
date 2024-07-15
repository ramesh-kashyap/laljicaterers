   <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Settings</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Admin Billing</a></li>
                    </ol>
                </div>
                <!-- row -->
                <div class="row">
     
     
                    <div class="col-xl-6 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Admin Billing</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="{{ route('admin.billing-to-admin') }}" method="POST">
                                     {{ csrf_field() }}
                                        <div class="row">
                                            <div class="mb-3 col-md-12">
                                                <label class="form-label">Admin ID</label>
                                                <input class="form-control" id="inputEmail3" readonly value="{{ $product->role }}"  placeholder="" type="text" name="role">
                                              
                                            </div>                                       
                                           
                                         
                                        </div>
                                        <button type="submit" class="btn btn-primary">Confirm</button>
                                    </form>
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

         