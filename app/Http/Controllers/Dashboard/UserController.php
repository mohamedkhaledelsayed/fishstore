<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;



class UserController extends Controller
{
  
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $title = trans('admin.users');
        $users = User::paginate(10);
        return view('dashboard.users.index', compact('users', 'title'));
    }


    public function search_in_table(Request $request)
    {
        if ($request->ajax()) {
            $columns = Schema::getColumnListing('users');
            $validator = Validator::make($request->all(), [
                'sort_type' => 'in:ASC,DESC',
                'column_name' => [Rule::in($columns)],
                'page' => 'int'
            ]);
            if ($validator->fails()) {
                return response(['status' => 'failed', 'message' => __('admin.invalid_parameters')]);
            }
            $users = User::when($request->search_value, function ($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', "%{$request->search_value}%");
                }
            })
                ->orderBy($request->column_name, $request->sort_type)->paginate(10);
            return view('dashboard.users.search_result', compact('users'))->render();
        }

        return abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $title = trans('admin.create') . ' ' . trans('admin.users');
        return view('dashboard.users.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'email' => 'required|email|unique:users,email|max:80|min:4',
            'phone' => 'required|max:30|min:6',
            'name' => 'required|min:3|max:80',
        ]);
        $data['password'] = bcrypt($request->password);

        $user = User::create($data);
        return redirect(route('users.index'))
            ->with('success', __('admin.field_created_success', ['name'=> __('admin.user')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return View
     */
    public function edit(User $user)
    {
        $title = trans('admin.edit') . ' ' . trans('admin.users');
        return view('dashboard.users.edit', compact('user', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, User $user)
    {
        $data = $this->validate($request, [
            'email' => 'required|max:50|min:4|email|unique:users,email,' . $user->id,
            'phone' => 'required|max:30|min:6',
            'name' => 'required|min:3|max:80',
            'active' => 'boolean',

        ]);
        if(!$request->active) {
            $data['active'] = 0;
        }
        $user->update($data);
        return redirect(route('users.index'))
            ->with('success', __('admin.field_updated_success', ['name'=> __('admin.user')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect(route('users.index'))
            ->with('success', __('admin.field_delete_success', ['name'=> __('admin.user')]));
    }
}
