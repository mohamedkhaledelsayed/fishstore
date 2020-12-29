@if($cities->count())
    @foreach($cities as $index => $city)
        <tr>
            <td>{{$index + 1}}</td>
            <td>{{$city->translate('en')->name}}</td>
            <td>{{$city->translate('ar')->name}}</td>
            <td>
                @if(auth()->user()->hasPermission('update-cities'))
                    <a href="{{route('cities.edit', $city->id )}}"
                       class="btn btn-info btn-sm">@lang('admin.edit') <i
                            class="fa fa-edit"></i></a>
                @else
                    <a href="" class="btn btn-info btn-sm disabled">@lang('admin.edit')
                        <i
                            class="fa fa-edit"></i></a>

                @endif
                @if(auth()->user()->hasPermission('delete-cities'))
                    <form action="{{route('cities.destroy',$city->id)}}"
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
            {{$cities->links()}}
        </td>
    </tr>
@else
    <tr>
        <td class="text-center get-colspan-numbers" colspan="">@lang('admin.no_data_to_show')</td>
    </tr>
@endif
