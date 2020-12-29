<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Attribute;
use App\ProductImage;
use App\ProductAttributesValues;
use App\Review;
use App\Notification;
use App\Http\Helpers\helper;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Collection;


class ProductController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:read-products')->only('index');
        $this->middleware('permission:create-products')->only('create', 'store');
        $this->middleware('permission:update-products')->only('edit', 'update');
        $this->middleware('permission:delete-products')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
    public function index()
    {
        $title= trans('admin.products');
        $products =Product::paginate(10);

        return view('dashboard.products.index',compact('products','title'));
    }
    public function search_in_table(Request $request)
    {
        if ($request->ajax()) {
            $columns = Schema::getColumnListing('products');
            $validator = Validator::make($request->all(), [
                'sort_type' => 'in:ASC,DESC',
                'column_name' => [Rule::in($columns)],
                'page' => 'int'
            ]);
            if ($validator->fails()) {
                return response(['status' => 'failed', 'message' => __('admin.invalid_parameters')]);
            }
            $products = Product::when($request->search_value, function ($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', "%{$request->search_value}%");
                }
                $q->orWhereTranslationLike('name', "%{$request->search_value}%");

            })
                ->orderBy($request->column_name, $request->sort_type)->paginate(10);
            return view('dashboard.products.search_result', compact('products'))->render();
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
        $title =trans('admin.categories');
        $categories= Category::get();
        $product= Product::first();
        $attributes =Attribute::get();
        return view('dashboard.products.create', compact('title', 'attributes','categories','product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    
 
    public function store(Request $request,Product $product)
    {
        $data = [];

        foreach (config('translatable.locales') as $one_lang) {
            $data += [$one_lang . '.name' => 'required|min:2|max:100'];
            $data += ['category_attributes.*.' .$one_lang => 'required'];
            $data += [$one_lang . '.descreption' => 'required|min:2|max:100'];

        }

        
       
        $data += [
            'cat_id'=>'required|integer',
            'price'=>'required',
            'offer_price'=>'sometimes',
            'image_cover'=>'required|image|mimes:jpg,png,jpeg,svg',
            'rating_avg'=>'sometimes|numeric'
            
        ];

        $data = $request->validate($data);

        if ($request->hasFile('image_cover')) {
            $file = $request->file('image_cover');
            $imageName ='productes'.'/'.time().$file->getClientOriginalName();
            
            $size = $file->getSize();
            $file->move(public_path('uploads/productes/'),$imageName);
            
            $data['image_cover']= $imageName;
          }
          $product= Product::create($data);
        

          $this->insert_attributes($request,$product);
          $dataimages=[
            'image'=>'sometimes|image|mimes:jpg,png,jpeg,svg',
          ];

          $dataimages= $request->validate($dataimages);
       
          if ($request->hasfile('images')) {
              foreach ($request->file('images') as $file) {
                  $name = 'productes'.'/'.time().$file->getClientOriginalName();
                  $file->move(public_path().'/uploads/productes/', $name);
                  $dataimages[] = $name;
              }
              foreach ($dataimages as $dataimage) {

                  $productimages= new ProductImage();
                  $productimages->product_id=$product->id;
             
                  $productimages->image=$dataimage;
                  $productimages->save();
              }
          }
          sendNotification('fishstore','Add new product successfully',null,$product->id);
          Notification::create(
              ['title'=>'fishstore',
              'body'=>'Add new product successfully',
              'product_id'=>$product->id
              ]);
          return redirect()->route('products.index');



    }
    public function insert_attributes($request,$product)
    {
        foreach($request->category_attributes as $attribute_id => $attribute) {
            $data = $attribute;
            $data['attribute_id'] = $attribute_id;
            $product->attributes()->create($data);
        }
    } 

   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::get();


        $attributes = Attribute::whereHas('attributesValues', function ($query) use ($product) {
            $query->where('product_id', $product->id);
        })->with(['attributesValues' => function($query ) use ($product){
            $query->where('product_id', $product->id);
        }])->get();
        
        return view('dashboard.products.edit', compact('product','categories','attributes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Product $product)
    {
        // dd($request->all());
        $data = [];

        foreach (config('translatable.locales') as $one_lang) {
            $data += [$one_lang . '.name' => 'required|min:2|max:100'];
            $data += ['category_attributes.*.' .$one_lang => 'required'];
            $data += [$one_lang . '.description' => 'required|min:2|max:100'];

        }

        
       
        $data += [
            'cat_id'=>'required|integer',
            'price'=>'required',
            'offer_price'=>'sometimes',
            'image_cover'=>'image|mimes:jpg,png,jpeg,svg',
        ];
        $data = $request->validate($data);

        if ($request->hasFile('image_cover')) {
            $file = $request->file('image_cover');
            $imageName ='productes'.'/'.time().$file->getClientOriginalName();
            
            $size = $file->getSize();
            $file->move(public_path('uploads/productes/'),$imageName);
            
            $data['image_cover']= $imageName;
          }

          $product= Product::find($product->id);
          
          $product->save();
          $product->update_attributes($request);

          $images=[
            'image'=>'sometimes|array',
            'image.*'=>'sometimes|image|mimes:jpg,png,jpeg,svg',
          ];

           $request->validate($images);
       
           $dataimages=[];

          if ($request->hasfile('images')) {
            $productimages = ProductImage::where('product_id',$product->id)->get();
            ProductImage::destroy( $productimages->pluck('id'));
              foreach ($request->file('images') as $file) {
                  $name = 'productes'.'/'.time().$file->getClientOriginalName();
                  $file->move(public_path().'/uploads/productes/', $name);
                  $dataimages[] = $name;
              }
              foreach ($dataimages as $dataimage) {

                $productimages= new ProductImage();
                $productimages->product_id=$product->id;
           
                $productimages->image=$dataimage;
                $productimages->save();
            }

              
          }

          return redirect()->route('products.index');




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product= Product::find($id);
        if(!empty($product->image_cover)) {
            if (file_exists(public_path('uploads/'. $product->image_cover))) {
              unlink(public_path('uploads/'. $product->image_cover));
            }
        }
        $product->delete();
        return redirect()->back();
    }

    public function showimages(Request $request){
        $productimages=ProductImage::where('product_id',$request->id)->get();
        return view('dashboard.products.show', compact('productimages'));
    }
    public function deleteimage($id){
        $productimage=ProductImage::find($id);
       
        if(!empty($productimage->image)) {
            if (file_exists(public_path('uploads/'. $productimage->image))) {
              unlink(public_path('uploads/'. $productimage->image));
            }
        }
        
        $productimage->delete();
        return redirect()->back();

    }

}
