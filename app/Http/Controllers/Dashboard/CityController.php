<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Government;
use App\City;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CityController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:read-cities')->only('index');
        $this->middleware('permission:create-cities')->only('create');
        $this->middleware('permission:update-cities')->only('edit');
        $this->middleware('permission:delete-cities')->only('destroy');
    }

    public function index()
    {
       

        $title = trans('admin.cities');
        $cities = City::paginate(10);
        return view('dashboard.cities.index', compact('cities', 'title'));
    }

   

    public function search_in_table(Request $request)
    {
        if ($request->ajax()) {
            $columns = Schema::getColumnListing('cities');
            $validator = Validator::make($request->all(), [
                'sort_type' => 'in:ASC,DESC',
                'column_name' => [Rule::in($columns)],
                'page' => 'int'
            ]);
            if ($validator->fails()) {
                return response(['status' => 'failed', 'message' => __('admin.invalid_parameters')]);
            }
            $cities = City::when($request->search_value, function ($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', "%{$request->search_value}%");
                }
                $q->orWhereTranslationLike('name', "%{$request->search_value}%");

            })
                ->orderBy($request->column_name, $request->sort_type)->paginate(10);
            return view('dashboard.cities.search_result', compact('cities'))->render();
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
        $title = trans('admin.governments');
        $governments=Government::get(); 
        return view('dashboard.cities.create',compact('governments'));
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
        $data +=[
            'shipping'=>'required|numeric',
            'gov_id'=>'required'
        ];
        $data = $request->validate($data);
       
        City::create($data);

        return redirect()->route('cities.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        $title = trans('admin.governments');
        $governments=Government::get(); 

        return view('dashboard.cities.edit', compact('city','governments', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $data = [];
        foreach (config('translatable.locales') as $one_lang) {
            $data += [$one_lang . '.name' => 'required|min:2|max:70'];
        }
        $data +=[
            'shipping'=>'required|numeric',
            'gov_id'=>'required'
        ];
        $data = $request->validate($data);
   
        $city->update($data);
        return redirect()->route('cities.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {

        $city->delete();
        return redirect()->route('cities.index')->with('success', 'admin.delete');
    }

  
}
