@extends('dashboard.layouts.app')

@section('content')

    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb bg-white">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-xs-12 align-self-center">
                <h5 class="font-medium text-uppercase mb-0">@lang('admin.settings')</h5>
            </div>
            <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                    <ol class="breadcrumb mb-0 justify-content-end p-0 bg-white">
                        <li class="breadcrumb-item  "><a href="{{admin('')}}">@lang('admin.dashboard')</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('admin.settings')</li>
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
                        <h4 class="card-title">@lang('admin.edit') @lang('admin.settings')</h4>
                        @include('dashboard.layouts.messages')
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <form action="{{route('settings.update',$setting->id)}}" method="post">
                                    @csrf
                                    @method('put')
                                    <div class="row">
                                            <div class="col-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="@lang('admin.phone_number')">@lang('admin.phone_number')</label>
                                                    
                                                    <input type="text" name="phone_number" placeholder="@lang('admin.phone_number')" class="form-control" value="{{old('phone_number',$setting->phone_number)}}">
                                                </div>
                                            </div>
                                            <div class="col-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="@lang('admin.link')">@lang('admin.link')</label>

                                                    
                                                    <input type="text" class="form-control" placeholder="@lang('admin.link')"  name="link" value="{{old('link',$setting->link)}}">
                                                </div>
                                            </div>
                                            <div class="col-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="@lang('admin.linkyoutube')">@lang('admin.linkyoutube')</label>

                                                    
                                                    <input type="text" class="form-control" placeholder="@lang('admin.linkyoutube')"  name="linkyoutube" value="{{old('linkyoutube',$setting->linkyoutube)}}">
                                                </div>
                                            </div>
                                            <div class="col-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="@lang('admin.linkmap')">@lang('admin.linkmap')</label>

                                                    
                                                    <input type="text" class="form-control" placeholder="@lang('admin.linkmap')"  name="linkmap" value="{{old('linkmap',$setting->linkmap)}}">
                                                </div>
                                            </div>

                                            @foreach(config('translatable.locales') as $locale)
                                                <div class="col-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="{{$locale}}.textabout">
                                                            @lang('admin.' . $locale. '.textabout')</label>
                                                        <textarea type="text" id="{{$locale}}.textabout"
                                                                  name="{{$locale}}[text]"
                                                                  class="form-control @error($locale.'.textabout') is-invalid @enderror "
                                                                  placeholder="@lang('admin.' . $locale . '.textabout')" rows="15"
                                                        >{{old($locale.'.textabout',$setting->translate($locale)->text)}}</textarea>
                                                    </div>
                                                </div>
                                            @endforeach
                                    </div>

                                    <button type="submit" class="btn btn-success mr-2">@lang('admin.edit')</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
