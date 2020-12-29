@section('attributes')
    @if($category->attributes->count())
        <div class="col-12" id="new_attributes">
            <hr>
            <h3 class="text-center">{{$category->name}} attributes</h3>
            <div class="row">
                @foreach(config('translatable.locales') as $locale)

                    @foreach($category->attributes as $attribute)
                            <div class="col-6 col-xs-12">
                                <div class="form-group">
                                    <label for="attribute{{$attribute->id}}">{{$attribute->translate($locale)->name}}</label>
                                    <input data-role="tagsinput"  id="attribute{{$attribute->id}}"
                                           name="category_attributes[{{$attribute->id}}][{{$locale}}][name]"
                                           class="form-control input-tags-ref @error('input-tags') is-invalid @enderror "
                                           value="{{old('input-tags')}}">
                                    <input type="hidden" name="category_attributes[{{$attribute->id}}][attribute_id]"
                                           value="{{$attribute->id}}">
                                </div>

                            </div>
   
                    @endforeach
                @endforeach

            </div>
        </div>
    @endif
@endsection
