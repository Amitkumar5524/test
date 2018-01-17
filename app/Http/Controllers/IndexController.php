<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use DB;
use App\Data;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;

class IndexController extends Controller
{
    public function addItem(Request $request)
    {
        $rules = array(
                'name' => 'required',
				'price' => 'required|numeric',
				'quantity' => 'required|numeric',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json(array(

                    'errors' => $validator->getMessageBag()->toArray(),
            ));
        } else {
            $data = new Data();
			$created_at = date("Y-m-d h:i:s");
            $data->name = $request->name;
			$data->quantity = $request->quantity;
			$data->price = $request->price;
			$data->created_at = $created_at;
			$data->updated_at = $created_at;
            $data->save();

            return response()->json($data);
        }
    }
    public function readItems(Request $req)
    {
        $data = Data::all();
		//dd($data);
        return view('welcome')->withData($data);
    }
    public function editItem(Request $req)
    {
        $data = Data::find($req->id);
		$created_at = date("Y-m-d h:i:s");
        $data->name = $req->name;
		$data->quantity = $req->quantity;
		$data->price = $req->price;
		$data->created_at = $created_at;
		$data->updated_at = $created_at;
        $data->save();

        return response()->json($data);
    }
    public function deleteItem(Request $req)
    {
        Data::find($req->id)->delete();

        return response()->json();
    }
}
