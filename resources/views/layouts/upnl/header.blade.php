<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Dashboard | {{siteName()}}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <base href="{{asset('')}}" >
        <link rel="shortcut icon" href="{{ asset('') }}assets/images/favicon.ico">
        <link href="{{ asset('') }}assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
        <link href="{{asset('')}}assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

        <!-- dropzone css -->
        <link href="{{asset('')}}assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />
    
        <link href="{{ asset('') }}assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('') }}assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet"
            type="text/css" />
    
        <!-- Responsive datatable examples -->
        <link href="{{ asset('') }}assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"
            type="text/css" />

            
        <!-- Bootstrap Css -->
        <link href="{{ asset('') }}assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('') }}assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('') }}assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    </head>

    <body data-sidebar="dark" data-layout-mode="light">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->
<style>
    span.badge.badge-danger {
    color: red;
    font-size: 15px;
}

span.badge.badge-success {
    color: green;
    font-size: 15px;
}
.rounded-circle {
    border-radius: 10% !important;
}
</style>
        <!-- Begin page -->
        <div id="layout-wrapper">

            
            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="index.html" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{ asset('') }}assets/images/logo.svg" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ asset('') }}assets/images/logo-dark.png" alt="" height="17">
                                </span>
                            </a>

                            <a href="index.html" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{asset('')}}main/images/logo.png" alt="" height="30">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{asset('')}}main/images/logo.png" alt="" style="    width: 64px;">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>

                        <!-- App Search-->
                        <form class="app-search d-none d-lg-block">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="bx bx-search-alt"></span>
                            </div>
                        </form>

                   
                    </div>

                    <div class="d-flex">

                        <div class="dropdown d-inline-block d-lg-none ms-2">
                            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-magnify"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-search-dropdown">
        
                                <form class="p-3">
                                    <div class="form-group m-0">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img id="header-lang-img" src="{{ asset('') }}assets/images/flags/us.jpg" alt="Header Language" height="16">
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="en">
                                    <img src="{{ asset('') }}assets/images/flags/us.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">English</span>
                                </a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="sp">
                                    <img src="{{ asset('') }}assets/images/flags/spain.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Spanish</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="gr">
                                    <img src="{{ asset('') }}assets/images/flags/germany.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">German</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="it">
                                    <img src="{{ asset('') }}assets/images/flags/italy.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Italian</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="ru">
                                    <img src="{{ asset('') }}assets/images/flags/russia.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Russian</span>
                                </a>
                            </div>
                        </div>

                      

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="{{ asset('') }}assets/images/users/avatar-1.jpg"
                                    alt="Header Avatar">
                                <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{Auth::user()->name}}</span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a class="dropdown-item" href="{{route('user.profile')}}"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Profile</span></a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="#"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span></a>
                            </div>
                        </div>

                     

                    </div>
                </div>
            </header>

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title" key="t-menu">Menu</li>

                            <li>
                              <a href="{{route('user.dashboard')}}" class="waves-effect">
                                <i class="bx bx-home-circle"></i>
                                  <span key="t-file-manager">Dashboard</span>
                              </a>
                          </li>


                        
                           
                            <li class="menu-title" key="t-apps">Apps</li>

                

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-user-circle"></i>
                                    <span key="t-dashboards">Profile</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{route('user.profile')}}" key="t-tui-calendar">Edit Profile</a></li>
                                    <li><a href="{{route('user.ChangePass')}}" key="t-full-calendar">Security</a></li>
                                </ul>
                            </li>

                            @if(Auth::user()->role=="Vendor")

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-store"></i>
                                    <span key="t-ecommerce">Add Product</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{route('user.AddFund')}}" key="t-products">Add Product</a></li>
                                   
                                    <li><a href="{{route('user.fundHistory')}}" key="t-add-product">My Product</a></li>
                                    {{-- <li><a href="{{route('user.sellerInvoice')}}" key="t-add-product">My Invoice</a></li> --}}
                                    
                                </ul>
                            </li>
                       


                            <li>
                                <a href="{{route('user.vendor_cards')}}" class=" waves-effect">
                                    <i class="bx bx-store"></i>
                                    <span key="t-ecommerce"> Buy Products</span>
                                </a>
                  
                            </li>
                            <li>
                                <a href="{{route('user.buy_products')}}" class=" waves-effect">
                                    <i class="bx bx-store"></i>
                                    <span key="t-ecommerce">Vendor's Menu</span>
                                </a>
                  
                            </li>
                                

                            

                            
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-store"></i>
                                    <span key="t-ecommerce">Vendor Menu</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">


                                    <li><a href="{{route('user.invest')}}" key="t-products">Billing Now</a></li>


                                   
                                    <li><a href="{{route('user.vender_history')}}" key="t-add-product">Billing Reports</a></li>
                                </ul>
                            </li>

                            @endif

                            @if(Auth::user()->role=="Agent")
                            <li>
                                <a href="{{route('user.categories_menu')}}" class="waves-effect">
                                    <i class="bx bx-envelope"></i>
                                    <span key="t-email"> Menu</span>
                                </a>
                                <!-- <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{route('user.GenerateTicket')}}" key="t-inbox">Support Ticket</a></li>
                                    <li><a href="{{route('user.SupportMessage')}}" key="t-read-email">Inbox</a></li>
                                    
                                </ul> -->
                            </li>
                            <li>
                                <a href="{{route('user.DepositHistory')}}" class="waves-effect">
                                    <i class="bx bx-store"></i>
                                    <span key="t-ecommerce">Customer Reports</span>
                                </a>
                             
                            </li>
                            @endif

                            <!-- <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-receipt"></i>
                                    <span key="t-invoices">My Team</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{route('user.referral-team')}}" key="t-invoice-list">Direct team</a></li>
                                    <li><a href="{{route('user.level-team')}}" key="t-invoice-detail">Level team</a></li>
                                </ul>
                            </li>


                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-receipt"></i>
                                    <span key="t-invoices">Profit Summary</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{route('user.roi-bonus')}}" key="t-invoice-list">Pool Profit</a></li>
                                    <li><a href="{{route('user.level-income')}}" key="t-invoice-detail">Royal Bonus</a></li>
                                </ul>
                            </li> -->



                            <!-- <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-detail"></i>
                                    <span key="t-crypto">Withdrawal </span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{route('user.withdraw')}}" key="t-wallet">Withdrawal Request</a></li>
                                    <li><a href="{{route('user.Withdraw-History')}}" key="t-buy">Withdrawal Reports</a></li>
                                
                                </ul>
                            </li> -->

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-envelope"></i>
                                    <span key="t-email">Supports</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{route('user.GenerateTicket')}}" key="t-inbox">Support Ticket</a></li>
                                    <li><a href="{{route('user.SupportMessage')}}" key="t-read-email">Inbox</a></li>
                                    
                                </ul>
                            </li>

                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();" class="waves-effect">
                                    <i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i>
                                    <span key="t-file-manager">Logout</span>
                                </a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                            class="d-none">
                            @csrf
                        </form>
  



                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->
