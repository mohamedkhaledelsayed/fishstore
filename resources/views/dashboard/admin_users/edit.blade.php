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
                                href="{{route('admin_users.index')}}">@lang('admin.users')</a></li>
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
                        <h4 class="card-title">@lang('admin.edit')</h4>
                        @include('dashboard.layouts.messages')
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <form action="{{route('admin_users.update',$admin_user->id)}}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="username">@lang('admin.username')</label>
                                                <input type="text" id="username" name="username"
                                                       class="form-control @error('username') is-invalid @enderror "
                                                       placeholder="@lang('admin.username')"
                                                       value="{{old('username',$admin_user->username)}}">
                                            </div>
                                        </div>
                                        <div class="col-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="name">@lang('admin.name')</label>
                                                <input type="text" id="name" name="name"
                                                       class="form-control @error('name') is-invalid @enderror"
                                                       placeholder="@lang('admin.name')" value="{{old('name',$admin_user->name)}}">
                                            </div>
                                        </div>
                                        <div class="col-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="password">@lang('admin.password')</label>
                                                <input type="password" id="password" name="password"
                                                       class="form-control @error('password') is-invalid @enderror"
                                                       placeholder="@lang('admin.password')" value="">
                                            </div>
                                        </div>
                                        <div class="col-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="password_confirmation">@lang('admin.password_confirmation')</label>
                                                <input type="password" id="password_confirmation" name="password_confirmation"
                                                       class="form-control @error('password_confirmation') is-invalid @enderror"
                                                       placeholder="@lang('admin.password_confirmation')" value="">
                                            </div>
                                        </div>
                                        <div class="col-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="email">@lang('admin.email')</label>
                                                <input type="email" id="email" name="email"
                                                       class="form-control @error('email') is-invalid @enderror"
                                                       placeholder="@lang('admin.email')" value="{{old('email',$admin_user->email)}}">
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="role_id">@lang('admin.role') </label>
                                                <select name="role_id" id="role_id"
                                                        class="form-control my-select-2 @error('role_id') is-invalid @enderror">
                                                    <option value="" selected disabled>@lang('admin.select_role')</option>
                                                    @foreach($roles as $role)
                                                        <option {{old('role_id',$admin_user->roles()->first()->id) === $role->id ? 'selected' : ''}}
                                                                value="{{$role->id}}">{{$role->display_name}}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
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
