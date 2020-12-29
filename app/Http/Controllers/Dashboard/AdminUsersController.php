<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AdminUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use App\Role;
use App\Permission;
class AdminUsersController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:read-admin_users')->only('index');
        $this->middleware('permission:create-admin_users')->only('create');
        $this->middleware('permission:update-admin_users')->only('edit');
        $this->middleware('permission:delete-admin_users')->only('destroy');
    }

    public function index()
    {
        $title = trans('admin.users');
        $users = AdminUsers::where('id', '!=', auth('admin')->user()->id)->paginate(10);
        return view('dashboard.admin_users.index', compact('users', 'title'));
    }

    public function search_in_table(Request $request)
    {
        if ($request->ajax()) {
            $columns = Schema::getColumnListing('admin_users');
            $validator = Validator::make($request->all(), [
                'sort_type' => 'in:ASC,DESC',
                'column_name' => [Rule::in($columns)],
                'page' => 'int'
            ]);
            if ($validator->fails()) {
                return response(['status' => 'failed', 'message' => __('admin.invalid_parameters')]);
            }
            $users = AdminUsers::with('roles')->when($request->search_value, function ($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', "%{$request->search_value}%");
                    $q->where('id', '!=', auth('admin')->user()->id);
                }

                $q->orWhereHas('roles',function ($q) use ($request) {
                    $q->where('display_name','LIKE',"%{$request->search_value}%");
                });
            })->where('id', '!=', auth('admin')->user()->id)
                ->orderBy($request->column_name, $request->sort_type)->paginate(10);
            return view('dashboard.admin_users.search_result', compact('users'))->render();
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
        $roles = Role::all_roles()->get();
        return view('dashboard.admin_users.create', compact('title', 'roles'));
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
        $roles = Role::all_roles()->pluck('id')->toArray();
        $data = $this->validate($request, [
            'username' => 'required|unique:admin_users|max:30|min:4',
            'email' => 'required|email|unique:admin_users|max:30|min:4',
            'password' => 'required|max:30|min:6|confirmed',
            'name' => 'required|min:3|max:50',
            'role_id' => ['required', 'int', Rule::in($roles)],
            'image' => 'sometimes|nullable|image',
        ]);
        if ($request->image) {
            $data['image'] = $request->image->store('users');
        }
        $data['password'] = bcrypt($request->password);

        $user = AdminUsers::create($data);
        $user->attachRole($request->role_id);
        return redirect(route('admin_users.index'))
            ->with('success', __('admin.field_created_success', ['name'=> __('admin.user')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param AdminUsers $admin_user
     * @return View
     */
    public function edit(AdminUsers $admin_user)
    {
        $title = trans('admin.create') . ' ' . trans('admin.users');
        $roles = Role::all_roles()->get();
        return view('dashboard.admin_users.edit', compact('admin_user', 'title', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param AdminUsers $admin_user
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, AdminUsers $admin_user)
    {
        $data = $this->validate($request, [
            'email' => 'required|max:50|min:4|email|unique:admin_users,email,' . $admin_user->id,
            'username' => 'required|max:50|min:4|unique:admin_users,username,' . $admin_user->id,
            'password' => 'confirmed',
            'name' => 'required|min:3|max:50',
            'role_id' => 'required|int',
            'image' => 'sometimes|image',

        ]);
        $data['password'] = $admin_user->password;
        $data['image'] = $admin_user->image;
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        if ($request->image) {
            $data['image'] = $request->image->store('admin_users');
            Storage::delete($admin_user->image);
        }
        $admin_user->update($data);
        $admin_user->syncRoles([$request->role_id]);
        return redirect(route('admin_users.index'))
            ->with('success', __('admin.field_updated_success', ['name'=> __('admin.user')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param AdminUsers $admin_user
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(AdminUsers $admin_user)
    {
        if($admin_user->image) {
            Storage::delete($admin_user->image);
        }
        $admin_user->delete();
        return redirect(route('admin_users.index'))
            ->with('success', __('admin.field_delete_success', ['name'=> __('admin.user')]));
    }
}
