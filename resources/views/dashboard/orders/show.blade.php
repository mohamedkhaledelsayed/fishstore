@extends('dashboard.layouts.app')

@section('content')
<style>
    p{
        font-size:20px;
        font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        margin-right: 10px;
        margin-left: 10px;
    }
</style>    
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb bg-white">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-xs-12 align-self-center">
                <h5 class="font-medium text-uppercase mb-0">@lang('admin.orders')</h5>
            </div>
            <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                    <ol class="breadcrumb mb-0 justify-content-end p-0 bg-white">
                        <li class="breadcrumb-item  "><a href="{{admin('')}}">@lang('admin.dashboard')</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> @lang('admin.orders')</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="page-content container-fluid">
        
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="table-responsive">
                        <table id="table_export" class="table table-striped table-bordered" style="width:100%">
                            @if (isset($ordersdetails))    
                            <tbody>
                            <tr>
                                
                                <td><h2>@lang('admin.product')</h2> </td>
                                <td> <p>{{$ordersdetails->Product-> name}} </p></td>
                           
                               
                            </tr>
                            <tr>
                                <td><h2>@lang('admin.orderusername')</h2></td>
                   
                               <td> <p> {{$ordersdetails->order->user->name}}</p></td>
                            </tr>
                            <tr>
                                <td><h2>@lang('admin.ordergovernment')</h2> </td>
                                <td> <p>{{$ordersdetails->order->government-> name}} </p></td>
                            </tr>
                            <tr>
                                <td><h2>@lang('admin.city')</h2> </td>
                                <td> <p>{{$ordersdetails->order->city-> name}} </p></td>
                            </tr>
                            <tr>
                                <td><h2>@lang('admin.phone_number')</h2> </td>
                                <td> <p> {{$ordersdetails->order->phone_number}}</p></td>
                            </tr>
                            <tr>
                                <td><h2>@lang('admin.price')</h2> </td>
                                <td> <p>{{$ordersdetails->price}} </p></td>
                            </tr>
                            <tr>
                                <td><h2>@lang('admin.quantity')</h2> </td>
                                <td> <p>{{$ordersdetails->quantity}} </p></td>
                            </tr>
                            <tr>
                                <td><h2>@lang('admin.total')</h2> </td>
                                <td> <p>{{$ordersdetails->order->total}} </p></td>
                            </tr>
                            
                            </tbody>
                            @else
                            <tr>
                                <td class="get-colspan-numbers" colspan="">@lang('admin.no_data_to_show')</td>
                            </tr>
                            @endif
                        </table>
                    
                   
                   
                    
                </div>
            </div>
        </div>            
    </div>  
@endsection

