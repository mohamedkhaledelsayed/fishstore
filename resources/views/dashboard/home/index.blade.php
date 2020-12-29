@extends('dashboard.layouts.app')

@section('content')
<style>
.notification {
  background-color: #555;
  color: white;
  text-decoration: none;
  padding: 15px 26px;
  position: relative;
  display: inline-block;
  border-radius: 2px;
}
.badge {
    font-size: 12px;
    font-weight:bold;
    position: absolute;
    top: 10px;
    right: 10px;
    padding: 10px 12px;
    border-radius: 50%;
    background-color: red;
    color: white;
  }
  </style>
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb bg-white">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-xs-12 align-self-center">
                    <h5 class="font-medium text-uppercase font-bold mb-0">@lang('admin.dashboard')</h5>
                </div>
                <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                    <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                        <ol class="breadcrumb mb-0 justify-content-end p-0 bg-white">
                            {{--                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>--}}
                            {{--                            <li class="breadcrumb-item active" aria-current="page"> @lang('admin.dashboard')</li>--}}
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="page-content container-fluid">
            <!-- ============================================================== -->
            <!-- Count Cards   -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-lg-3 col-md-6" >
                    <div class="card border-bottom border-success">
                        <div class="card-body">
                            <a href="{{route('attributes.index')}}">
                                <div class="d-flex no-block align-items-center">
                                    <div>
                                        <h1 class="text-success ">@lang('admin.Attribute')</h1>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="text-success display-4"><i class="fas fa-align-left"></i></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" >
                    <div class="card border-bottom border-success">
                        <div class="card-body">
                            <a href="{{route('governments.index')}}">
                                <div class="d-flex no-block align-items-center">
                                    <div>
                                        <h2 class="text-success ">@lang('admin.government')</h2>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="text-success display-4"><i class="fas fa-flag"></i></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" >
                    <div class="card border-bottom border-success">
                        <div class="card-body">
                            <a href="{{route('cities.index')}}">
                                <div class="d-flex no-block align-items-center">
                                    <div>
                                        <h1 class="text-success ">@lang('admin.city')</h1>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="text-success display-4"><i class="fas fa-shopping-cart"></i></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" >
                    <div class="card border-bottom border-cyan">
                        <div class="card-body">
                            <a href="{{route('categories.index')}}">
                                <div class="d-flex no-block align-items-center">
                                    <div>
                                        <h1 class="text-cyan">@lang('admin.categories') </h1>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="text-cyan display-4"><i class="fas fa-sitemap"></i></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" >
                    <div class="card border-bottom border-success">
                        <div class="card-body">
                            <a href="{{route('products.index')}}">
                                <div class="d-flex no-block align-items-center">
                                    <div>
                                        <h1 class="text-success ">@lang('admin.products')</h1>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="text-success display-4"><i class="fas fa-shopping-cart"></i></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" >
                    <div class="card border-bottom border-orange">
                        <div class="card-body">
                              
                                <span class="badge">{{$orderscount}}</span>
                             
                            <a href="{{route('orders.index')}}">
                                <div class="d-flex no-block align-items-center">
                                    <div>
                                        <h1 class="text-orange ">@lang('admin.orders')</h1>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="text-orange display-4"><i class="fa fa-list-alt"></i></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" >
                    <div class="card border-bottom border-dark">
                        <div class="card-body">
                            <a href="{{route('users.index')}}">
                                <div class="d-flex no-block align-items-center">
                                    <div>
                                        <h1 class="text-black ">@lang('admin.customers')</h1>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="text-black display-4"><i class="fas fa-users"></i></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
      
                <div class="col-lg-3 col-md-6" >
                    <div class="card border-bottom border-orange">
                        <div class="card-body">
                            <a href="{{route('admin_users.index')}}">
                                <div class="d-flex no-block align-items-center">
                                    <div>
                                        <h1 class="text-orange ">@lang('admin.admins')</h1>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="text-orange display-4"><i class="fas fa-user-circle"></i></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" >
                    <div class="card border-bottom border-dark">
                        <div class="card-body">
                            <a href="{{route('notification.index')}}">
                                <div class="d-flex no-block align-items-center">
                                    <div>
                                        <h2 class="text-black ">@lang('admin.notifications')</h2>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="text-black display-4"><i class="ti-bell"></i></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" >
                    <div class="card border-bottom border-dark">
                        <div class="card-body">
                            <a href="{{route('settings.index')}}">
                                <div class="d-flex no-block align-items-center">
                                    <div>
                                        <h1 class="text-black ">@lang('admin.settings')</h1>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="text-black display-4"><i class="ti-settings"></i></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

            <!-- ============================================================== -->
            <!-- End of Count Cards   -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>

@endsection
