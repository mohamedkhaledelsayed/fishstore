@extends('dashboard.layouts.app')

@section('content')

    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb bg-white">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-xs-12 align-self-center">
                <h5 class="font-medium text-uppercase mb-0">@lang('admin.cities')</h5>
            </div>
            <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                    <ol class="breadcrumb mb-0 justify-content-end p-0 bg-white">
                        <li class="breadcrumb-item  "><a href="{{admin('')}}">@lang('admin.dashboard')</a></li>
                        <li class="breadcrumb-item  "><a
                                href="{{route('cities.index')}}">@lang('admin.cities')</a></li>
                        <li class="breadcrumb-item active"
                            aria-current="page"> @lang('admin.edit') @lang('admin.city')</li>
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
                        <h4 class="card-title">@lang('admin.edit') @lang('admin.city')</h4>
                        @include('dashboard.layouts.messages')
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <form action="{{route('cities.update',$city->id)}}" method="post">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="lat" id="lat" value="{{old('lat',$city->lat)}}">
                                    <input type="hidden" name="lon" id="lon" value="{{old('lon',$city->lon)}}">
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
                                                           value="{{old($locale.'.name',$city->translate($locale)->name)}}">
                                                </div>
                                            </div>

                                        @endforeach
                                        <div class="col-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="@lang('admin.shipping')">@lang('admin.shipping')</label>

    
                                                <input type="text" class="form-control" placeholder="@lang('admin.shipping')"  name="shipping"  value="{{old('shipping',$city->shipping)}}">
                                            </div>
                                        </div>
                                        <div class="col-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="@lang('admin.government')">@lang('admin.government')</label>
                                                <select id="demo"  name="gov_id">
                                                    @foreach($governments as $government)
                                                  <option value="{{$government ->id}}" {{ old('gov_id', $government->id) == $city->gov_id? 'selected' : '' }}>
                                                      
                                                       {{$government ->name}}

                                                  </option>
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
@push('js')
<script>

    new SlimSelect({
        select: '#demo'
    })
    
</script>
@endpush