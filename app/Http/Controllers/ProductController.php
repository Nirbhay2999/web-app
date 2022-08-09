<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $data = new Product();
        $data->email = $request->email;
        $data->password = $request->password;
        $data->save();
        return redirect()->route('index')->with('message','Successfully Inserted!');
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
        $data->password=$request->password;
        $data->save();
        return redirect()->route('index');

     }
     public function delete($id)
     {
        $data = Product::find($id);
        $data->delete();
        return redirect()->route('index');
     }
}
