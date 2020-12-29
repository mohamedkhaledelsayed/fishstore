@extends('dashboard.layouts.app')

@section('content')

    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb bg-white">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-xs-12 align-self-center">
                <h5 class="font-medium text-uppercase mb-0">@lang('admin.customers')</h5>
            </div>
            <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                    <ol class="breadcrumb mb-0 justify-content-end p-0 bg-white">
                        <li class="breadcrumb-item  "><a href="{{admin('')}}">@lang('admin.dashboard')</a></li>
                        <li class="breadcrumb-item  "><a
                                href="{{route('users.index')}}">@lang('admin.customers')</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> @lang('admin.add')</li>
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
        <div class="row">
            <div class="col-md-12">
                <div class="card card-body">
                    <div class="card card-body">
                        <h4 class="card-title">@lang('admin.add')</h4>
                        @include('dashboard.layouts.messages')
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <form action="{{route('users.store')}}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="name">@lang('admin.name')</label>
                                                <input type="text" id="name" name="name" required
                                                       class="form-control @error('username') is-invalid @enderror"
                                                       placeholder="@lang('admin.name')" value="{{old('name')}}">
                                            </div>
                                        </div>

                                        <div class="col-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="email">@lang('admin.email')</label>
                                                <input type="email" id="email" name="email" required
                                                       class="form-control @error('email') is-invalid @enderror"
                                                       placeholder="@lang('admin.email')" value="{{old('email')}}">
                                            </div>
                                        </div>
                                        <div class="col-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="phone">@lang('admin.phone')</label>
                                                <input type="text" id="phone" name="phone" required
                                                       class="form-control @error('phone') is-invalid @enderror"
                                                       placeholder="@lang('admin.phone')" value="">
                                            </div>
                                        </div>
                                    </div>


                                    <button type="submit" class="btn btn-success mr-2">@lang('admin.create')</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
