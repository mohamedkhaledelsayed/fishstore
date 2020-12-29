<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Attribute;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AttributeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:read-attributes')->only('index');
        $this->middleware('permission:create-attributes')->only('create', 'store');
        $this->middleware('permission:update-attributes')->only('edit', 'update');
        $this->middleware('permission:delete-attributes')->only('destroy');
    }

    public function index()
    {
       

        $title = trans('admin.attributes');
        $attributes = Attribute::paginate(10);
        return view('dashboard.attributes.index', compact('attributes', 'title'));
    }

   

    public function search_in_table(Request $request)
    {
        if ($request->ajax()) {
            $columns = Schema::getColumnListing('attributes');
            $validator = Validator::make($request->all(), [
                'sort_type' => 'in:ASC,DESC',
                'column_name' => [Rule::in($columns)],
                'page' => 'int'
            ]);
            if ($validator->fails()) {
                return response(['status' => 'failed', 'message' => __('admin.invalid_parameters')]);
            }
            $attributes = Attribute::when($request->search_value, function ($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', "%{$request->search_value}%");
                }
                $q->orWhereTranslationLike('name', "%{$request->search_value}%");

            })
                ->orderBy($request->column_name, $request->sort_type)->paginate(10);
            return view('dashboard.attributes.search_result', compact('attributes'))->render();
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
        $title = trans('admin.attributes');
        return view('dashboard.attributes.create',compact('title'));
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
        $data += [
            'image' => 'sometimes|image|mimes:jpg,png,jpeg,svg',
        ];
        $data = $request->validate($data);
       
        Attribute::create($data);

        return redirect()->route('attributes.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Attribute $attribute)
    {
        $title = trans('admin.attributes');

        return view('dashboard.attributes.edit', compact('attribute', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attribute $attribute)
    {
        $data = [];
        foreach (config('translatable.locales') as $one_lang) {
            $data += [$one_lang . '.name' => 'required|min:2|max:70'];
        }
     
        $data = $request->validate($data);
   
        $attribute->update($data);
        return redirect()->route('attributes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attribute $attribute)
    {

        $attribute->delete();
        return redirect()->route('attributes.index')->with('success', 'admin.delete');
    }

  
 
}
