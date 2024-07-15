
		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
			<style>
		.card {
    margin-bottom: 1.875rem;
    background-color: #fff;
    transition: all .5s ease-in-out;
    position: relative;
    border: 0rem solid transparent;
    border-radius: 0.75rem;
    box-shadow: 0.4rem 0.5rem 0.5rem rgb(0 0 0 / 10%);
    height: calc(100% - 30px);
}
.fs-16 {
    font-size: 1rem !important;
    line-height: 1.6;
    text-shadow: 0.5px 0.6px #b6b6b6;
    color: #000;
}
.menu h2, .menu .h2 {
    font-size: 1.5rem;
    font-weight: 600;
}
			</style>
			<div class="container-fluid">
				<div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
					<h2 class="mb-3 me-auto" style="color:#000">Dashboard</h2>
					<div>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
							<li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
						</ol>
					</div>
				</div>	
				<div class="row">
					<div class="col-xl-12">
						<div class="row">
							<div class="col-xl-4 col-sm-4">
								<div class="card">
									<div class="card-body d-flex align-items-center justify-content-between">
										<div class="menu">
											<span class="font-w500 fs-16 d-block mb-2">Total Category</span>
											<h2>{{ \App\Models\Category::whereNotNull('categoryname')->count() }}</h2>
										</div>	
										<div class="d-inline-block position-relative donut-chart-sale">
										
											<img src="{{asset('admin/images/streamline.png')}}" style="width: 80px;" alt="">
											
										</div>
									</div>
								</div>
							</div>
							@php 
    $agentproducts = \App\Models\Product::whereNotNull('productName')->count();
    $vendorproducts = \App\Models\Vproduct::whereNotNull('productName')->count();
    $total = $agentproducts + $vendorproducts;
@endphp
							<div class="col-xl-4 col-sm-4">
								<div class="card">
									<div class="card-body d-flex align-items-center justify-content-between">
										<div class="menu">
											<span class="font-w500 fs-16 d-block mb-2">Total Product</span>
											<h2>{{$total}}</h2>
										</div>	
										<div class="d-inline-block position-relative donut-chart-sale">
											
                                                <img src="{{asset('admin/images/streamline.png')}}" style="width: 80px;" alt="">
											
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-4 col-sm-4">
								<div class="card">
									<div class="card-body d-flex align-items-center justify-content-between">
										<div class="menu">
											<span class="font-w500 fs-16 d-block mb-2">Total Agent Product</span>
											<h2>{{ \App\Models\Product::whereNotNull('productName')->count() }}</h2>
										</div>	
										<div class="d-inline-block position-relative donut-chart-sale">
											
                                                <img src="{{asset('admin/images/streamline.png')}}" style="width: 80px;" alt="">
											
										</div>
									</div>
								</div>
							</div>
							<!-- <div class="col-xl-4 col-sm-4">
								<div class="card">
									<div class="card-body d-flex align-items-center justify-content-between">
										<div class="menu">
											<span class="font-w500 fs-16 d-block mb-2">Total Agent Category</span>
											<h2>{{\App\Models\User::where('jdate',Date("Y-m-d"))->count()}}</h2>
										</div>	
										<div class="d-inline-block position-relative donut-chart-sale">
											
                                                <img src="{{asset('admin/images/streamline.png')}}" style="width: 80px;" alt="">
											
										</div>
									</div>
								</div>
							</div> -->
                            <!-- <div class="col-xl-4 col-sm-4">
								<div class="card">
									<div class="card-body d-flex align-items-center justify-content-between">
										<div class="menu">
											<span class="font-w500 fs-16 d-block mb-2">Total Vendor Product</span>
											<h2>{{ \App\Models\Vproduct::whereNotNull('productName')->count() }}</h2>
										</div>	
										<div class="d-inline-block position-relative donut-chart-sale">
										
                                                <img src="{{asset('admin/images/investment.png')}}" style="width: 80px;" alt="">
											
										</div>
									</div>
								</div>
							</div> -->
							<div class="col-xl-4 col-sm-4">
								<div class="card">
									<div class="card-body d-flex align-items-center justify-content-between">
										<div class="menu">
											<span class="font-w500 fs-16 d-block mb-2">Total Customer</span>
											<h2>{{\App\Models\User::count()}} </h2>
										</div>	
										<div class="d-inline-block position-relative donut-chart-sale">
                                            
											
                                                <img src="{{asset('admin/images/withdrawal.png')}}" style="width: 80px;" alt="">
									
										</div>
									</div>
								</div>
							</div>
							<!-- <div class="col-xl-4 col-sm-4">
								<div class="card">
									<div class="card-body d-flex align-items-center justify-content-between">
										<div class="menu">
											<span class="font-w500 fs-16 d-block mb-2">Total Pool Profit</span>
											<h2>{{ currency() }} {{  number_format((\App\Models\Income::where('remarks','Pool Profit')->sum('comm')),2)   }}</h2>
										</div>	
										<div class="d-inline-block position-relative donut-chart-sale">
											
                                                <img src="{{asset('admin/images/pool_comission.png')}}" style="width: 80px;" alt="">
											
										</div>
									</div>
								</div>
							</div> -->
							<!-- <div class="col-xl-4 col-sm-4">
								<div class="card">
									<div class="card-body d-flex align-items-center justify-content-between">
										<div class="menu">
											<span class="font-w500 fs-16 d-block mb-2">Total Bonanza Bonus</span>
											<h2>{{ currency() }} {{  number_format((\App\Models\Income::where('remarks','Bonanza Bonus')->sum('comm')),2)   }}</h2>
										</div>	
										<div class="d-inline-block position-relative donut-chart-sale">
										
                                                <img src="{{asset('admin/images/medal.png')}}" style="width: 80px;" alt="">
										
										</div>
									</div>
								</div>
							</div> -->
<!-- 

                            <div class="col-xl-4 col-sm-4">
								<div class="card">
									<div class="card-body d-flex align-items-center justify-content-between">
										<div class="menu">
											<span class="font-w500 fs-16 d-block mb-2">Total Reward Bonus</span>
											<h2>{{ currency() }} {{  number_format((\App\Models\Income::where('remarks','Reward Bonus')->sum('comm')),2)   }} </h2>
										</div>	
										<div class="d-inline-block position-relative donut-chart-sale">
											
                                                <img src="{{asset('admin/images/investment.png')}}" style="width: 80px;" alt="">
											
										</div>
									</div>
								</div>
							</div> -->



                            <!-- <div class="col-xl-4 col-sm-4">
								<div class="card">
									<div class="card-body d-flex align-items-center justify-content-between">
										<div class="menu">
											<span class="font-w500 fs-16 d-block mb-2">Pending Withdrawal</span>
											<h2>{{ currency() }} {{  number_format((\App\Models\Withdraw::where('status','Pending')->sum('amount')),2)   }} </h2>
										</div>	
										<div class="d-inline-block position-relative donut-chart-sale">
											
                                                <img src="{{asset('admin/images/withdrawal.png')}}" style="width: 80px;" alt="">
											
										</div>
									</div>
								</div>
							</div> -->

                            <!-- <div class="col-xl-4 col-sm-4">
								<div class="card">
									<div class="card-body d-flex align-items-center justify-content-between">
										<div class="menu">
											<span class="font-w500 fs-16 d-block mb-2">Approved Withdrawal</span>
											<h2>{{ currency() }} {{  number_format((\App\Models\Withdraw::where('status','Approved')->sum('amount')),2)   }}</h2>
										</div>	
										<div class="d-inline-block position-relative donut-chart-sale">
											
                                                <img src="{{asset('admin/images/withdrawal.png')}}" style="width: 80px;" alt="">
											
										</div>
									</div>
								</div>
							</div> -->

						</div>
					</div>

                 
					
				</div>
				
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
		
		
	