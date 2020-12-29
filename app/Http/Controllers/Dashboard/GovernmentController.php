<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Government;

use App\City;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
class GovernmentController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:read-governments')->only('index');
        $this->middleware('permission:create-governments')->only('create', 'store');
        $this->middleware('permission:update-governments')->only('edit', 'update');
        $this->middleware('permission:delete-governments')->only('destroy');
    }

    public function index()
    {
       

        $title = trans('admin.governments');
        $governments = Government::paginate(10);
        return view('dashboard.governments.index', compact('governments', 'title'));
    }

   

    public function search_in_table(Request $request)
    {
        if ($request->ajax()) {
            $columns = Schema::getColumnListing('governments');
            $validator = Validator::make($request->all(), [
                'sort_type' => 'in:ASC,DESC',
                'column_name' => [Rule::in($columns)],
                'page' => 'int'
            ]);
            if ($validator->fails()) {
                return response(['status' => 'failed', 'message' => __('admin.invalid_parameters')]);
            }
            $governments = Government::when($request->search_value, function ($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', "%{$request->search_value}%");
                }
                $q->orWhereTranslationLike('name', "%{$request->search_value}%");

            })->orderBy($request->column_name, $request->sort_type)->paginate(10);
            return view('dashboard.governments.search_result', compact('governments'))->render();
        }

        return abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.governments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [];
        foreach (config('translatable.locales') as $one_lang) {
            $data += [$one_lang . '.name' => 'required|min:2|max:70'];
        }
      
        $data = $request->validate($data);
       
        Government::create($data);

        return redirect()->route('governments.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Government $government)
    {
        $title = trans('admin.governments');

        return view('dashboard.governments.edit', compact('government', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Government $government)
    {
        $data = [];
        foreach (config('translatable.locales') as $one_lang) {
            $data += [$one_lang . '.name' => 'required|min:2|max:70'];
        }
     
        $data = $request->validate($data);
   
        $government->update($data);
        return redirect()->route('governments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Government $government)
    {

        $government->delete();
        return redirect()->route('governments.index')->with('success', 'admin.delete');
    }

  
 
}
