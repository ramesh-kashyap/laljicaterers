<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
        
                <div class="row page-titles">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Vender </a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Vender Products</a></li>
                    </ol>
                </div>
                <!-- row -->
        
        
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Vender Products</h4>
                            </div>
                            <div class="card-body">
        
        
                                <div class="table-responsive">
                                    
        
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Sr No
                                                </th>
                                                
        
                                                <th>UserName</th>
                                                <th>Amount</th>
                                                <th>Discount Price</th>
                                                <th>Status</th>
                                                <th>Payment Mode</th>
                                
                                                <th>Request Date</th>
                                                <th>Action</th>
                                               
                                                
        
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
        
                                            <?php if(is_array($product_list) || is_object($product_list)){ ?>
        
                                            <?php $cnt = $product_list->perPage() * ($product_list->currentPage() - 1); ?>
                                            @foreach ($product_list as $value)
                                                <tr>
                                                    
                                                    <td><?= $cnt += 1?></td>
        
                                                    <td> {{ $value->user_id_fk }}</td>
        
        
                                                    <td>  {{ currency() }}{{ $value->amount }}</td>
                                                    <td> 
                                                        {{ $value->discount}}</td>
                                                    <td> 
                                                        {{ $value->status}}</td>
                                                    <td>
                                                        {{ $value->payment_mode}}</td>
                                                  
        
        
                                                    <td>{{ date('D, d M Y h:i:s a', strtotime($value->created_at)) }} </td>
                                                   
        
                                                  
        
                                                    <td><a href="{{ route('admin.vendor_invoice_b', ['id'=> Crypt::encrypt($value->id)]) }}" class="btn btn-primary btn-sm btn-rounded" >
                                                                Generate Menu
                                                            </a></td>
        
                                                </tr>
                                            @endforeach
        
                                            <?php }?>
                                        </tbody>
        
                                    </table>
        
                                    <br>
        

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
        