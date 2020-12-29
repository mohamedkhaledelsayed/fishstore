@extends('dashboard.layouts.app')

@section('content')
    @php
        $types = ['content','big_list','small_list'];
    @endphp
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb bg-white">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-xs-12 align-self-center">
                <h5 class="font-medium text-uppercase mb-0">@lang('admin.categories')</h5>
            </div>
            <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                    <ol class="breadcrumb mb-0 justify-content-end p-0 bg-white">
                        <li class="breadcrumb-item  "><a href="{{admin('')}}">@lang('admin.dashboard')</a></li>
                        <li class="breadcrumb-item  "><a
                                href="{{route('categories.index')}}">@lang('admin.categories')</a></li>
                        <li class="breadcrumb-item active"
                            aria-current="page"> @lang('admin.edit') @lang('admin.category')</li>
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
                        <h4 class="card-title">@lang('admin.edit') @lang('admin.category')</h4>
                        @include('dashboard.layouts.messages')
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <form action="{{route('categories.update',$category->id)}}" method="post" enctype="multipart/form-data">
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
                                                           value="{{old($locale.'.name',$category->translate($locale)->name)}}">
                                                </div>
                                            </div>
                                        @endforeach
                    
                                            <div class="col-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="image">@lang('admin.image') </label>
                                                    <input type="file" name="image" id="image"
                                                           class="form-control @error('image') is-invalid @enderror">
                                                           <img src="{{get_image_path($category->image)}}" style="width:150px;height:150px" alt="no image" srcset="">       
                                                        </div>
                                            </div>

                                    <div class="col-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="@lang('admin.Attribute')">@lang('admin.Attribute')</label>
                                                    <select id="demo" multiple="multiple"  name="attributes[]">
                                                        @foreach($attributes as $attribute)
                                                        @if(in_array($attribute->id, $categoryAttributeIds))
                                                        <option value="{{ $attribute->id }}" selected="true">{{ $attribute->name }}</option>
                                                        @else
                                                        <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                                                        @endif 
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