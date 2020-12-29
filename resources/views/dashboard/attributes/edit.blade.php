@extends('dashboard.layouts.app')

@section('content')

    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb bg-white">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-xs-12 align-self-center">
                <h5 class="font-medium text-uppercase mb-0">@lang('admin.Attribute_permission')</h5>
            </div>
            <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                    <ol class="breadcrumb mb-0 justify-content-end p-0 bg-white">
                        <li class="breadcrumb-item  "><a href="{{admin('')}}">@lang('admin.dashboard') </a></li>
                        <li class="breadcrumb-item  "><a href="{{route('attributes.index')}}">@lang('admin.Attribute') </a></li>
                        <li class="breadcrumb-item active" aria-current="page"> @lang('admin.edit')</li>
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
                        <h4 class="card-title width">@lang('admin.edit')</h4>
                        @include('dashboard.layouts.messages')
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <form action="{{route('attributes.update',$attribute->id)}}" method="post" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                            @foreach(config('translatable.locales') as $locale)
                            <div class="col-6 col-xs-12">
                                <div class="form-group">
                                    <label for="{{$locale}}.name">
                                        @lang('admin.' . $locale. '.name')</label>
                                    <input type="text" id="{{$locale}}.name"
                                           name="{{$locale}}[name]"
                                           class="form-control @error($locale.'.name') is-invalid @enderror "
                                           placeholder="@lang('admin.' . $locale . '.name')"
                                           value="{{old($locale.'.name',$attribute->translate($locale)->name)}}">
                                </div>
                            </div>
                        @endforeach
    
                       

                        
                    </div>

                    <button type="submit" class="btn btn-success mr-2">@lang('admin.edit')</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @push('js')
        <script>
            let allAttribute = $('.role-checkbox'),
                allAttributeChecked  = $('.role-checkbox:checked'),
                i = 0;

            if(allAttribute.length !== allAttributeChecked.length) {
                $('#select-all-checkbox').prop('checked', false);
            }

            $('#select-all-checkbox').on('click', function () {

                allAttribute.prop('checked', $(this).prop('checked'));
            });
            allAttribute.on('click',function () {
                 $('#select-all-checkbox').prop('checked',allAttribute.length === $('.role-checkbox:checked').length );
            })
        </script>
    @endpush
@endsection
