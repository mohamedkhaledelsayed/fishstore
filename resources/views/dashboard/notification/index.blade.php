@extends('dashboard.layouts.app')

@section('content')

    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb bg-white">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-xs-12 align-self-center">
                <h5 class="font-medium text-uppercase mb-0">@lang('admin.notifications')</h5>
            </div>
            <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                    <ol class="breadcrumb mb-0 justify-content-end p-0 bg-white">
                        <li class="breadcrumb-item  "><a href="{{admin('')}}">@lang('admin.dashboard')</a></li>
                        <li class="breadcrumb-item active"
                            aria-current="page"> @lang('admin.add') @lang('admin.notifications')</li>
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
                        <h4 class="card-title">@lang('admin.add') @lang('admin.notifications')</h4>
                        @include('dashboard.layouts.messages')
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <form action="{{route('notifications.store')}}" method="post">
                                    @csrf

                                    <div class="col-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="@lang('admin.titlenotification')">@lang('admin.titlenotification')</label>


                                            <input type="text" class="form-control" placeholder="@lang('admin.titlenotification')"  name="title" >
                                        </div>
                                    </div>   

                                    <div class="col-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="@lang('admin.bodynotification')">
                                                @lang('admin.bodynotification')</label>
                                            <textarea id="@lang('admin.bodynotification')"
                                                   name="body" 
                                                   class="form-control @error('description') is-invalid @enderror "
                                                   placeholder="@lang('admin.bodynotification')"
                                                   >{{old('bodynotification')}}</textarea>
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