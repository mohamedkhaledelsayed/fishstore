@extends('dashboard.layouts.app')

@section('content')

    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb bg-white">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-xs-12 align-self-center">
                <h5 class="font-medium text-uppercase mb-0">@lang('admin.products')</h5>
            </div>
            <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                    <ol class="breadcrumb mb-0 justify-content-end p-0 bg-white">
                        <li class="breadcrumb-item  "><a href="{{admin('')}}">@lang('admin.dashboard')</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> @lang('admin.products')</li>
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
        @include('dashboard.layouts.messages')

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header border">
                        <h3 class="d-inline">@lang('admin.products')</h3>
                        <a href="{{route('products.create')}}" class="btn btn-primary">@lang('admin.add') <i
                                class="fa fa-plus"></i></a>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="search-in-table">
                                    @lang('admin.search')
                                    <input type="search" id="search-in-table" placeholder="@lang('admin.search')"
                                           class="form-control">
                                </label>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="table_export" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th scope="col" class="border " data-sort-name="id"
                                        data-sort-type="DESC">#
                                        <img class="sort-type-image" src="{{asset('admin/image/sort_both.png')}}"
                                             alt="">
                                        <span class="sort-type-icon fa fa-sort-up d-none"></span>
                                    </th>
                                    <th scope="col" class="border" >
                                        @lang('admin.en.name')

                                    </th>
                                    <th scope="col" class="border " >
                                        @lang('admin.ar.name')

                                    </th>

                                    <th scope="col" class="border search-sorting" data-sort-name="id"
                                    data-sort-type="image">@lang('admin.image')
                                    <img class="sort-type-image" src="{{asset('admin/image/sort_both.png')}}"
                                         alt="">
                                    <span class="sort-type-icon fa fa-sort-up d-none"></span>
                                    </th>

                                    <th scope="col" class="border">@lang('admin.action')</th>
                                </tr>
                                </thead>
                                <tbody id="search-data-append-tbody">
                                @if($products->count())
                                    @foreach($products as $index => $product)
                                        <tr>
                                            <td>{{$index + 1}}</td>
                                            <td>{{$product->translate('en')->name}}</td>
                                            <td>{{$product->translate('ar')->name}}</td>
                                            <td><img src="{{get_image_path($product->image_cover)}}" alt="" style="width:150px;height:150px"> </td>

                                            <td>
                                                @if(auth()->user()->hasPermission('update-products'))
                                                    <a href="{{route('products.edit', $product->id )}}"
                                                       class="btn btn-info btn-sm">@lang('admin.edit') <i
                                                            class="fa fa-edit"></i></a>
                                                @else
                                                    <a href="" class="btn btn-info btn-sm disabled">@lang('admin.edit')
                                                        <i
                                                            class="fa fa-edit"></i></a>

                                                @endif
                                                @if(auth()->user()->hasPermission('delete-products'))
                                                    <form action="{{route('products.destroy',$product->id)}}"
                                                          method="post"
                                                          style="display: inline-block">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit"
                                                                class="btn btn-danger btn-sm delete-btn">@lang('admin.delete')
                                                            <i class="fa fa-trash"></i></button>
                                                        @else
                                                            <button type="submit"
                                                                    class="btn btn-danger btn-sm delete-btn"
                                                                    disabled>@lang('admin.delete')
                                                                <i class="fa fa-trash"></i></button>
                                                        @endif
                                                        <a href="{{route('productimages', $product->id )}}"
                                                            class="btn btn-info btn-sm">@lang('admin.showimages') <i
                                                                class="fa fa-show"></i></a>

                                                    </form>
                                            </td>
                                         
                                        </tr>
                                    @endforeach
                                    <tr class="">
                                        <td class="get-colspan-numbers">
                                            {{$products->links()}}
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td class="get-colspan-numbers" colspan="">@lang('admin.no_data_to_show')</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
