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
                        <li class="breadcrumb-item  "><a
                                href="{{route('products.index')}}">@lang('admin.products')</a></li>
                        <li class="breadcrumb-item active"
                            aria-current="page"> @lang('admin.edit') @lang('admin.product')</li>
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
                        <h4 class="card-title">@lang('admin.edit') @lang('admin.product')</h4>
                        @include('dashboard.layouts.messages')
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <form action="{{route('products.update',$product->id)}}" method="post" enctype="multipart/form-data">
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
                                                           value="{{old($locale.'.name',$product->translate($locale)->name)}}">
                                                </div>
                                            </div>

                                        @endforeach
                                        
                                        @foreach(config('translatable.locales') as $locale)
                                        <div class="col-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="{{$locale}}.description">
                                                    @lang('admin.' . $locale. '.description')</label>
                                                <textarea id="{{$locale}}.description"
                                                       name="{{$locale}}[description]" 
                                                       class="form-control @error($locale.'.description') is-invalid @enderror "
                                                       placeholder="@lang('admin.' . $locale . '.description')"
                                                       >{{old($locale.'.description',$product->translate($locale)->descreption)}}   </textarea>
                                            </div>
                                        </div>
                                        @endforeach
                                   
                                        <div class="col-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="@lang('admin.price')">@lang('admin.price')</label>

    
                                                <input type="text"  name="price" value='{{old('price',$product->price)}}' class="form-control @error('price') is-invalid @enderror" placeholder="@lang('admin.price')"   >
                                            </div>
                                        </div>

                                        <div class="col-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="@lang('admin.offerprice')">@lang('admin.offerprice')</label>

    
                                                <input type="text" class="form-control" value="{{old('offer_price',$product->offer_price)}}" placeholder="@lang('admin.offerprice')"  name="offer_price" >
                                            </div>
                                        </div>
                                        <div class="col-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="coverimage">@lang('admin.coverimage') </label>
                                                <input type="file" name="image_cover" id="coverimage" 
                                                        class="form-control @error('coverimage') is-invalid @enderror">
                                                 <img src="{{asset('uploads' . '/' .$product->image_cover)}}" alt="no image" srcset="" style="width:150px;height: 150px;">       
                                            </div>
                                        </div>

                                        <div class="col-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="images">@lang('admin.images') </label>
                                                <input type="file" multiple name="images[]" id="images"
                                                        class="form-control @error('images') is-invalid @enderror">
                                            </div>
                                        </div>



                                        <div class="col-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="first_parent_id">@lang('admin.category') </label>
                                                <select name="cat_id" id="first_parent_id" required
                                                        class="form-control my-select-2 @error('first_parent_id') is-invalid @enderror">
                                                    <option value="" selected
                                                            disabled>@lang('admin.select') @lang('admin.category')</option>
                                                    @foreach($categories as $category)
                                                        <option
                                                            {{old('first_parent_id',$product->cat_id) == $category->id ? 'selected' : ''}}
                                                            value="{{$category->id}}">
                                                            {{$category->name}}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                
                                        @if($attributes->count())
                                        <div class="col-12" id="new_attributes">
                                            <hr>
                                            <h3 class="text-center">{{$product->name}} attributes</h3>
                                            <div class="row">
                                                @foreach(config('translatable.locales') as $locale)

                                                    @foreach($attributes as $index => $attribute)
                                                            <div class="col-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label for="attribute{{$attribute->id}}">{{$attribute->translate($locale)->name}}</label>
                                                                    <input data-role="tagsinput"  id="attribute{{$attribute->id}}"
                                                                           name="category_attributes[{{$attribute->id}}][{{$locale}}][name]"
                                                                           class="form-control tagz @error('input-tags') is-invalid @enderror "
                                                                            value="{{old("category_attributes[$attribute->id][$locale][name]",$attribute->attributesValues->count() ?
                                                                                    $attribute->attributesValue->translate($locale)->name : '')}}">
                                                                    <input type="hidden" name="category_attributes[{{$attribute->id}}][attribute_id]"
                                                                            value="{{old("category_attributes[$attribute->id][attribute_id]",$attribute->id)}}">
                                                                </div>
                                                               
                                                            </div>
                                                      
                                                            
                                                           
                                                    @endforeach
                                                @endforeach

                                            </div>
                                        </div>

                                        
                                    @endif

                                  
                            </div>
<div class="col-12">
                                        <div id="append-attr">
                                            <div class="col-12">

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
$('#first_parent_id').on('change', function () {
        $.get({
            url: adminUrl + '/categories/attributes/' + $(this).val(),
            success: function (data) {
                if (data.status === 'success') {
                    $('#new_attributes').remove();
                    let dataToAppend = data.view;
                    $('#append-attr div.col-12:last').before(dataToAppend.attributes);
                    $('.input-tags-ref').tagsinput('refresh');
                }
            }
        });
    });
 
</script>
@endpush