<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\OrderDetails;
use DB;
class OrderController extends Controller
{
    public function search_in_table(Request $request)
    {
        if ($request->ajax()) {
            $columns = Schema::getColumnListing('orders');
            $validator = Validator::make($request->all(), [
                'sort_type' => 'in:ASC,DESC',
                'column_name' => [Rule::in($columns)],
                'page' => 'int'
            ]);
            if ($validator->fails()) {
                return response(['status' => 'failed', 'message' => __('admin.invalid_parameters')]);
            }
            $orders = Order::when($request->search_value, function ($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', "%{$request->search_value}%");
                }
                $q->orWhereTranslationLike('name', "%{$request->search_value}%");

            })
                ->orderBy($request->column_name, $request->sort_type)->paginate(10);
            return view('dashboard.orders.search_result', compact('orders'))->render();
        }

        return abort(404);
    }   
    
    public function index()
    {
        $orders= Order::with(['User','government','city'])->orderBy('id','DESC')->paginate();
        
        return view('dashboard.orders.index',compact('orders'));
    }
    public function ordershow(Request $request ,$id){
        $ordersdetails= OrderDetails::where('order_id',$request->id)->first();
        return view('dashboard.orders.show',compact('ordersdetails'));
    } 

 
    public function destroy(Request $request ,$id)
    {
        $Order=Order::findOrfail($id);

        $Order->delete();

        return redirect()->back()->with('success', 'admin.delete');

    }

   
    public function update($req,request $request)
{
   $order =  order::where('id',$req)->update([
      'case'=>$request->active,
    ]);
     $user = order::select('user_id')->where('id',$req)->with(['User'])->first();
    session()->flash('success',trans('admin.updated'));
    if($request->active == 1):
         sendNotification($user->user->reg_id,'accept','acceptOrder',$req,$user->user->device_type,"order");
    else:
         sendNotification($user->user->reg_id,'refuesa','refuesaOrder',$req,$user->user->device_type,"order");
    endif;
    return back();
}

}
