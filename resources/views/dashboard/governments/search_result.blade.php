@if($governments->count())
@foreach($governments as  $government)
    <tr>
        <td>{{$government->id}}</td>
        <td>{{$government->translate('en')-> name}}</td>
        <td>{{$government->translate('ar')-> name}}</td>
        <td>
            @if(auth()->user()->hasPermission('update-governments'))
                <a href="{{route('governments.edit', $government->id )}}"
                   class="btn btn-info btn-sm">@lang('admin.edit') <i
                        class="fa fa-edit"></i></a>
            @else
                <a href="" class="btn btn-info btn-sm disabled">@lang('admin.edit')
                    <i
                        class="fa fa-edit"></i></a>

            @endif
            @if(auth()->user()->hasPermission('delete-governments'))
                <form action="{{route('governments.destroy',$government->id)}}"
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

                </form>
        </td>
    </tr>
@endforeach
<tr class="">
    <td class="get-colspan-numbers">
        {{$governments->links()}}
    </td>
</tr>
@else
<tr>
    <td class="get-colspan-numbers" colspan="">@lang('admin.no_data_to_show')</td>
</tr>
@endif