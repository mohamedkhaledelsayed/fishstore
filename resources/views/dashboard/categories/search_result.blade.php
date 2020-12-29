@if($categories)
@foreach($categories as $category)
    <tr>
        <td>{{$category->id}}</td>

        <td>{{$category->translate('en')->name}}</td>
        
        <td>{{$category->translate('ar')->name}}</td>
        <td><img src="{{get_image_path($category->image)}}" alt="" style="width:150px;height:150px"> </td>

        
        <td>
            @if(auth()->user()->hasPermission('update-categories'))
                <a href="{{route('categories.edit', $category->id )}}"
                   class="btn btn-info btn-sm">@lang('admin.edit') <i
                        class="fa fa-edit"></i></a>
            @else
                <a href="" class="btn btn-info btn-sm disabled">@lang('admin.edit')
                    <i
                        class="fa fa-edit"></i></a>

            @endif
                <form action="{{route('categories.delete',$category->id)}}"
                      method="post"
                      style="display: inline-block">
                    @csrf
                    @method('delete')
                    <button type="submit"
                            class="btn btn-danger btn-sm delete-btn">@lang('admin.delete')
                        <i class="fa fa-trash"></i></button>
                   
                </form>
        </td>
    </tr>
@endforeach
<tr class="">
    <td class="get-colspan-numbers">
        {{$categories->links()}}
    </td>
</tr>
@else
<tr>
    <td class="get-colspan-numbers" colspan="">@lang('admin.no_data_to_show')</td>
</tr>
@endif