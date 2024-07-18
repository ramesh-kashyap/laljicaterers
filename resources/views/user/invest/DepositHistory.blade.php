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
                        <h4 class="mb-sm-0 font-size-18">Product Reports</h4>
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
                                        <th>Address</th>
                                        <th>Payment Mode</th>
                                        <th>Billing Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        
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
                                                <td>{{ $value->address }}</td>
                                                <td>{{ $value->mode ? $value->mode : "Cash" }}</td>
                                                <td>{{ $value->sdate }}</td>
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
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
</div>
<!-- ============================================================== -->
