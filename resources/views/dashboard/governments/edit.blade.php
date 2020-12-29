@extends('dashboard.layouts.app')

@section('content')

    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb bg-white">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-xs-12 align-self-center">
                <h5 class="font-medium text-uppercase mb-0">@lang('admin.governments')</h5>
            </div>
            <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                    <ol class="breadcrumb mb-0 justify-content-end p-0 bg-white">
                        <li class="breadcrumb-item  "><a href="{{admin('')}}">@lang('admin.dashboard')</a></li>
                        <li class="breadcrumb-item  "><a
                                href="{{route('governments.index')}}">@lang('admin.governments')</a></li>
                        <li class="breadcrumb-item active"
                            aria-current="page"> @lang('admin.edit') @lang('admin.government')</li>
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
                        <h4 class="card-title">@lang('admin.edit') @lang('admin.government')</h4>
                        @include('dashboard.layouts.messages')
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <form action="{{route('governments.update',$government->id)}}" method="post">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="short_name" id="short_name" value="{{old('short_name',$government->short_name)}}">
                                    <input type="hidden" name="lat" id="lat" value="{{old('lat',$government->lat)}}">
                                    <input type="hidden" name="lon" id="lon" value="{{old('lon',$government->lon)}}">
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
                                                           value="{{old($locale.'.name',$government->translate($locale)->name)}}">
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
    @push('js')




        <script>
            $('#map').locationpicker({
                location:
                    {
                        latitude: '{{old('lat',$government->lat)}}',
                        longitude: '{{old('lon',$government->lon)}}',
                    },
                zoom: 8,
                inputBinding: {
                    locationNameInput: $('#address'),
                    latitudeInput: $('#lat'),
                    longitudeInput: $('#lon')
                },
                enableAutocomplete: true,
                autocompleteOptions: {
                    type: ['(cities)'],

                },
                addressFormat :'government',
                onchanged: function (currentLocation, radius, isMarkerDropped) {
                    if ($(this).locationpicker('map').location.addressComponents.government) {
                        document.getElementById('en.name').value = $(this).locationpicker('map').location.addressComponents.government;
                        $('#short_name').val($(this).locationpicker('map').location.addressComponents.shortCountry)
                    }
                },
            });
        </script>

    @endpush
@endsection
