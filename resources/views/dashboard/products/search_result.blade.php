@if($products->count())
@foreach($products as $index => $product)
    <tr>
        <td>{{$index + 1}}</td>
        <td>{{$product->translate('en')->name}}</td>
        <td>{{$product->translate('ar')->name}}</td>
        <td><img src="{{get_image_path($product->image_cover)}}" alt="" style="width:150px;height:150px"> </td>

        <td>
            @if(auth()->user()->hasPermission('update-products'))
                <a href="{{route('products.edit', $product->id )}}"
                   class="btn btn-info btn-sm">@lang('admin.edit') <i
                        class="fa fa-edit"></i></a>
            @else
                <a href="" class="btn btn-info btn-sm disabled">@lang('admin.edit')
                    <i
                        class="fa fa-edit"></i></a>

            @endif
            @if(auth()->user()->hasPermission('delete-products'))
                <form action="{{route('products.destroy',$product->id)}}"
                      method="post"
                      style="display: inline-block">
                    @csrf
                    @method('delete')
                    <button type="submit"
                            class="btn btn-danger btn-sm delete-btn">@lang('admin.delete')
                        <i class="fa fa-trash"></i></button>
                    @else
                        <button type="submit"
                                class="btn btn-danger btn-sm delete-btn"
                                disabled>@lang('admin.delete')
                            <i class="fa fa-trash"></i></button>
                    @endif
                    <a href="{{route('productimages', $product->id )}}"
                        class="btn btn-info btn-sm">@lang('admin.showimages') <i
                            class="fa fa-show"></i></a>

                </form>
        </td>
     
    </tr>
@endforeach
<tr class="">
    <td class="get-colspan-numbers">
        {{$products->links()}}
    </td>
</tr>
@else
<tr>
    <td class="get-colspan-numbers" colspan="">@lang('admin.no_data_to_show')</td>
</tr>
@endif