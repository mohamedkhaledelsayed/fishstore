<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Attribute;
use App\Category;
use App\CategoryAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\categoryattributes;

class CategoryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:read-categories')->only('index');
        $this->middleware('permission:create-categories')->only('create', 'store');
        $this->middleware('permission:update-categories')->only('edit', 'update');
        $this->middleware('permission:delete-categories')->only('destroy');
    }

    public function index()
    {
       

        $title = trans('admin.categories');
        $categories = Category::paginate(10);
        return view('dashboard.categories.index', compact('categories', 'title'));
    }

    public function search_in_table(Request $request)
    {
        if ($request->ajax()) {
            $columns = Schema::getColumnListing('categories');
            $validator = Validator::make($request->all(), [
                'sort_type' => 'in:ASC,DESC',
                'column_name' => [Rule::in($columns)],
                'page' => 'int'
            ]);
            if ($validator->fails()) {
                return response(['status' => 'failed', 'message' => __('admin.invalid_parameters')]);
            }
            $categories = Category::when($request->search_value, function ($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', "%{$request->search_value}%");
                }
                $q->orWhereTranslationLike('name', "%{$request->search_value}%");

            })
                ->orderBy($request->column_name, $request->sort_type)->paginate(10);
            return view('dashboard.categories.search_result', compact('categories'))->render();
        }

        return abort(404);
    }   

    public function create()
    {
        $title = trans('admin.categories');
        
        $attributes = Attribute::get();

    
        return view('dashboard.categories.create', compact('attributes','title'));
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

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName ='categories'.'/'.time().$file->getClientOriginalName();
            
            $size = $file->getSize();
            $file->move(public_path('uploads/categories/'),$imageName);

            $data['image']= $imageName;
          }



        
       $category= Category::create($data);
       $category->attributes()->attach(request('attribute'));

        return redirect()->route('categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $title = trans('admin.categories');
        $categoryAttributeIds = [];
        $attributes = Attribute::all();
        foreach($category->attributes as $categoryAttribute)
        {
            $categoryAttributeIds[] = $categoryAttribute->id;
        } 
   
        return view('dashboard.categories.edit', compact('categoryAttributeIds','category','attributes','title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $data = [];
        foreach (config('translatable.locales') as $one_lang) {
            $data += [$one_lang . '.name' => 'required|min:2|max:70'];
        }
        $data += [
          
            'image' => 'sometimes|image|mimes:jpg,png,jpeg,svg',
        ];
        $data = $request->validate($data);
        if($request->image) {
            $file = $request->file('image');
            $imageName ='categories'.'/'.time().$file->getClientOriginalName();
            
            $size = $file->getSize();
            $file->move(public_path('uploads/categories/'),$imageName);

            $data['image']= $imageName;
        }

        $category->update($data);

            $category->attributes()->sync(request('attributes'));
       
      

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $category =category::find($id);

       
        if(!empty($category->image)) {
            if (file_exists(public_path('uploads/'. $category->image))) {
              unlink(public_path('uploads/'. $category->image));
            }
        }
       
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'admin.delete');
    }


    public function destroy_category_attribute(Category $category, Attributes $attributes)
    {
        $category_attribute = CategoryAttributes::where([
            'category_id' => $category->id,
            'attribute_id' => $attributes->id,
        ])->first();
        if ($category_attribute) {
            $category_attribute->delete();
            return redirect()->route('categories.edit', $category->id)->with(__('admin.delete'));
        }
        return redirect()->route('categories.index');

    }

    public function store_category_attribute(Request $request, Category $category)
    {
        $data = [];
        foreach (config('translatable.locales') as $one_lang) {
            $data += [$one_lang . '.name' => 'required|min:2|max:70'];
        }
        $data += [
            'type' => 'required|in:content,big_list,small_list'
        ];
        $data = $request->validate($data);
        $category->attributes()->create($data);
        return redirect()->route('categories.edit', $request->category_id);
    }



    public function get_attributes(Category $category)
    {
        $view = view('dashboard.categories.attributes', ['category' => $category])->renderSections();
        return response(['status' => 'success', 'view' => $view]);
    }
    
 
}