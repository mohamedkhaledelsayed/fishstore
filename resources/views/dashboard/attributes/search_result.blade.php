@if($attributes)
@foreach($attributes as $attribute)
    <tr>
        <td>{{$attribute->id}}</td>

        <td>{{$attribute->translate('en')->name}}</td>
        
        <td>{{$attribute->translate('ar')->name}}</td>
      
        <td>
            @if(auth()->user()->hasPermission('update-attributes'))
                <a href="{{route('attributes.edit', $attribute->id )}}"
                   class="btn btn-info btn-sm">@lang('admin.edit') <i
                        class="fa fa-edit"></i></a>
            @else
                <a href="" class="btn btn-info btn-sm disabled">@lang('admin.edit')
                    <i
                        class="fa fa-edit"></i></a>

            @endif
            @if(auth()->user()->hasPermission('delete-attributes'))
                <form action="{{route('attributes.destroy',$attribute->id)}}" method="post"
                      style="display: inline-block">
                    @csrf
                    @method('delete')
                    <button type="submit"
                            class="btn btn-danger btn-sm delete-btn">@lang('admin.delete')
                        <i class="fa fa-trash"></i></button>
                </form>
            @else
                <button type="submit"
                        class="btn btn-danger btn-sm delete-btn"
                        disabled>@lang('admin.delete')
                    <i class="fa fa-trash"></i></button>
            @endif


        </td>
    </tr>
@endforeach
<tr class="">
    <td class="get-colspan-numbers">
        {{$attributes->links()}}

    </td>
</tr>
@else
<tr>
    <td class="get-colspan-numbers" colspan="">@lang('admin.no_data_to_show')</td>
</tr>
@endif