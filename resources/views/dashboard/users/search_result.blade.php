@if($users)
    @foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->phone}}</td>
            <td class="text-center"><i
                    class="fa fa-2x fa-{{$user->active ? 'check  text-success' : 'times-circle '}}"></i>
            </td>
            <td>
                @if(auth()->user()->hasPermission('update-customers'))
                    <a href="{{route('users.edit', $user->id )}}"
                       class="btn btn-info btn-sm">@lang('admin.edit') <i
                            class="fa fa-edit"></i></a>
                @else
                    <a href="" class="btn btn-info btn-sm disabled">@lang('admin.edit')
                        <i
                            class="fa fa-edit"></i></a>

                @endif
                @if(auth()->user()->hasPermission('delete-customers'))
                    <form action="{{route('users.destroy',$user->id)}}"
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
            {{$users->links()}}
        </td>
    </tr>
@else
    <tr>
        <td class="get-colspan-numbers" colspan="">@lang('admin.no_data_to_show')</td>
    </tr>
@endif
