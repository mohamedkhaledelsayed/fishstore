@extends('dashboard.layouts.app')

@section('content')

    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb bg-white">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-xs-12 align-self-center">
                <h5 class="font-medium text-uppercase mb-0">@lang('admin.roles')</h5>
            </div>
            <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                    <ol class="breadcrumb mb-0 justify-content-end p-0 bg-white">
                        <li class="breadcrumb-item  "><a href="{{admin('')}}">@lang('admin.dashboard')</a></li>
                        <li class="breadcrumb-item  "><a href="{{route('roles.index')}}">@lang('admin.roles')</a></li>
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
                                <form action="{{route('roles.store')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>@lang('admin.display_name')</label>
                                        <input type="text" name="display_name"
                                               class="form-control @error('display_name') is-invalid @enderror"
                                               placeholder="@lang('admin.display_name')" value="{{old('first_name')}}">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('admin.description')</label>
                                        <input type="text" name="description"
                                               class="form-control @error('description') is-invalid @enderror"
                                               placeholder="@lang('admin.description')" value="{{old('last_name')}}">
                                    </div>
                                    <div class="form-group">
                                        <h4 class="card-title">  @lang('admin.permission')</h4>
                                        <div>
                                            <div class="custom-control custom-checkbox ">

                                                <input type="checkbox" id="select-all-checkbox"
                                                       class="custom-control-input" >

                                                <label class="custom-control-label"
                                                       for="select-all-checkbox">@lang('admin.select_all')</label>
                                            </div>
                                        </div>
                                        <div class="roles-parent">

                                            @foreach($permissions as $permission)
                                                <div class="custom-control custom-checkbox one-role">
                                                    <input type="checkbox"
                                                           class="custom-control-input role-checkbox  @error('permissions') is-invalid @enderror"
                                                           value="{{$permission->id}}" name="permissions[]"
                                                           id="customCheck{{$permission->id}}">
                                                    <label class="custom-control-label"
                                                           for="customCheck{{$permission->id}}">{{$permission->display_name}}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>


                                    <button type="submit" class="btn btn-success mr-2">@lang('admin.save')</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @push('js')
        <script>
            let allRoles = $('.role-checkbox'),
                allRolesChecked  = $('.role-checkbox:checked');

            $('#select-all-checkbox').on('click', function () {

                allRoles.prop('checked', $(this).prop('checked'));
            });
            allRoles.on('click',function () {
                $('#select-all-checkbox').prop('checked',allRoles.length === $('.role-checkbox:checked').length );
            })
        </script>
    @endpush
@endsection
