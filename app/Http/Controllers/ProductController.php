<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;

use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required',
            'name' => 'required',
            'price' => 'required',
            'upc' => 'required',
            'password' => 'required',
            'image'=>'Required',
        ]);
        $data = new Product();
        $data->email = $request->email;
        $data->name = $request->name;
        $data->price = $request->price;
        $data->upc = $request->upc;
        $data->password = $request->password;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/products/',$filename);
            $data->image = $filename;
        }
        $data->status=$request->status;

        $data->save();

        return redirect()->route('index')->with('message','Successfully Inserted...!');
    }
    public function create()
    {
        return view('create');
    }
    public function index()
     {
        $data = Product::paginate(5);
        return view('index',compact('data'));
     }
     public function edit($id)
     {
        $data = Product::find($id);
        return view('edit',compact('data'));
     }
     public function update(Request $request,$id)
     {
        $data = Product::find($id);
        $data->email=$request->email;
        $data->name = $request->name;
        $data->price = $request->price;
        $data->price = $request->price;
        $data->password=$request->password;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/products/',$filename);
            $data->image = $filename;
        }
        $data->status=$request->status;
        $data->save();
        return redirect()->route('index')->with('message','Successfully Updated...!');

     }
     public function delete($id)
     {
        $data = Product::find($id);
        $data->delete();
        return redirect()->route('index')->with('message','Successfully Deleted...!');
     }

       //multipleusersdelete
       public function deleteMultiple(Request $request)
       {
           $ids = $request->ids;
           Product::whereIn('id',explode(",",$ids))->delete();
           return response()->json(['status'=>true,'message'=>"Product deleted successfully."]);

       }
}
