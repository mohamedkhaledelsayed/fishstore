<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Permission;
use App\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class RolesController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:read-roles')->only('index');
        $this->middleware('permission:create-roles')->only('create');
        $this->middleware('permission:update-roles')->only('edit');
        $this->middleware('permission:delete-roles')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $roles = Role::all_roles()->paginate(10);
        $title = trans('admin.roles');
        return view('dashboard.roles.index', compact('roles', 'title'));
    }

    public function search_in_table(Request $request)
    {
        if ($request->ajax()) {
            $columns = Schema::getColumnListing('roles');
            $validator = Validator::make($request->all(), [
                'sort_type' => 'in:ASC,DESC',
                'column_name' => [Rule::in($columns)],
                'page' => 'int'
            ]);
            if ($validator->fails()) {
                return response(['status' => 'failed', 'message' => __('admin.invalid_parameters')]);
            }
            $roles = Role::when($request->search_value, function ($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', "%{$request->search_value}%")
                        ->where('name', '!=', 'no-role');
                }
            })->where('name', '!=', 'no-role')->orderBy($request->column_name, $request->sort_type)->paginate(10);
            return view('dashboard.roles.search_result', compact('roles'))->render();
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
        $title = trans('admin.create') . ' ' . trans('admin.roles');
        $permissions = Permission::all();
        return view('dashboard.roles.create', compact('permissions', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $permissions = $request->permissions;
//        var_dump($role);
//        dd($request->all());

        $valid = $this->validate($request, [
            'display_name' => 'required|unique:roles,name',
            'description' => 'sometimes|nullable',
        ]);


        $name = str_replace(' ', '_', $request->display_name);

        $role = new Role;
        $role->name = $name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->save();
        foreach ($permissions as $id) {
            $permission = Permission::find($id);
            $role->attachPermission($permission);

        }


        session()->flash('success', trans('admin.added'));
        return redirect()->route('roles.index');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $title = trans('admin.edit') . ' ' . trans('admin.roles');

        $permissions = Permission::all();
        return view('dashboard.roles.edit', compact('role', 'permissions', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Role $role, Request $request)
    {
        $permissions = $request->permissions;

        $valid = $this->validate($request, [
            'display_name' => 'required|unique:roles,name,' . $role->id,
            'description' => 'sometimes|nullable',
        ]);
        $name = str_replace(' ', '-', $request->display_name);
        $role->name = $name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->update();

        $role->syncPermissions($permissions);

        session()->flash('success', trans('admin.updated'));
        return redirect(admin('roles'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Role $role)
    {
        if (auth('admin')->user()->hasRole($role->name)) {
            return redirect(admin('roles'))
                ->withErrors(__('admin.you_should_not_delete_your_rule'));
        }
        if (Role::all()->count() <= 1) {
            return redirect(admin('roles'))
                ->withErrors(__('admin.you_should_have_more_than_one_role_to_delete_it'));
        }
        if ($role->admin_users()->count()) {
            foreach ($role->admin_users()->get() as $admin_user) {
                $admin_user->attachRole('no-role');
            }
        }
        $role->delete();
        session()->flash('success', trans('admin.delete'));
        return redirect(admin('roles'));
    }
}