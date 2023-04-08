<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class RestApiController extends Controller
{
    public function usershow($id=null){
        if($id==''){
            $user=User::get();
            return response()->json(['user'=> $user],200);
        }else{
            $user=User::find($id);
            return response()->json(['user'=>$user],300);
        }
    }

    public function user_add(Request $request){
      if($request->isMethod('post')){
          $data =$request->all();
          //return $data;
          $rules=[
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required',
        ];
        $custommessage=[
            'name.required'=>'Name is required',
            'email.required'=>'Email is required',
            'email.email'=>'Email must be  valid email',
            'password.required'=>'password is required',
        ];
        $validator=Validator::make($data,$rules,$custommessage);
        if ($validator->fails()) {
            return response()->json($validator->errors(),433);
        }

        
          User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=> bcrypt($request->password),
          ]);
          $massage="user successfully added";
          return response()->json(['massage'=>$massage],201);
      }
    }
}
