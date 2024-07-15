   <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
               
                <div class="row">
     
     
                    <div class="col-xl-6 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit Vendor List</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="{{ route('admin.edit_vendor_post') }}" method="POST">
                                     {{ csrf_field() }}

                                     <input  type="hidden" name="id"
                                       value="{{ $product ? $product->id : '0' }}"
                                       >

                                        <div class="row">
                                            <div class="mb-3 col-md-12">
                                                <label class="form-label">Member Id</label>
                                                <input class="form-control" id="inputEmail3" placeholder="Member Id" value="{{$product->username}}" type="text" name="username">
                                            </div>
     
                                           
                                            <div class="mb-3 col-md-12">
                                                <label class="form-label">Name</label>
                                                <input class="form-control" id="inputEmail3" placeholder="Enter name" value="{{$product->name}}" type="" name="name">
                                            </div>
                                            <div class="mb-3 col-md-12">
                                                <label class="form-label">Email</label>
                                                <input class="form-control" id="inputEmail3" placeholder="Enter Email" value="{{$product->email}}" type="text" name="email">
                                            </div>

                                            <div class="mb-3 col-md-12">
                                                <label class="form-label">Mobile Number</label>
                                                <input class="form-control" id="inputEmail3" placeholder="Mobile Number" value="{{$product->phone}}" type="text" name="phone">
                                            </div>
                                             <div class="mb-3 col-md-12">
                                                <label class="form-label">Member</label>
                                                <select class="form-control" id="inputEmail3" placeholder="Member" value="{{$product->role}}" type="" name="role">
                                                    <option value="Agent"> Agent</option>
                                                    <option value="Vendor"> Vendor</option>
                                                </select>
                                            </div>


                                                       
                                        </div>
     
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox">
                                                <label class="form-check-label">
                                                    Check me out
                                                </label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
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
     