@if($roles->count())
    @foreach($roles as $index => $role)
        <tr>
            <td>{{$index + 1}}</td>
            <td>{{$role->display_name}}</td>
            <td>{{$role->description}}</td>
            <td>
                @if(auth()->user()->hasPermission('update-roles'))
                    <a href="{{route('roles.edit', $role->id )}}"
                       class="btn btn-info btn-sm">@lang('admin.edit') <i
                            class="fa fa-edit"></i></a>
                @else
                    <a href="" class="btn btn-info btn-sm disabled">@lang('admin.edit')
                        <i
                            class="fa fa-edit"></i></a>

                @endif
                @if(auth()->user()->hasPermission('delete-roles'))
                    <form action="{{route('roles.destroy',$role->id)}}" method="post"
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
    <tr>
        <td class="get-colspan-numbers">{{$roles->links()}}</td>
    </tr>
@else
    <tr class="text-center">
        <td class="get-colspan-numbers" colspan="">@lang('admin.no_data_to_show')</td>
    </tr>
@endif
