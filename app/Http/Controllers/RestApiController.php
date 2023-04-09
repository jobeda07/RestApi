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

    public function multiple_user_add(Request $request){
        if($request->isMethod('post')){
            $data =$request->all();
            //return $data;
            $rules=[
              'users.*.name'=>'required',
              'users.*.email'=>'required|email|unique:users',
              'users.*.password'=>'required',
          ];
          $custommessage=[
              'users.*.name.required'=>'Name is required',
              'users.*.email.required'=>'Email is required',
              'users.*.email.email'=>'Email must be  valid email',
              'users.*.password.required'=>'password is required',
          ];
          $validator=Validator::make($data,$rules,$custommessage);
          if ($validator->fails()) {
              return response()->json($validator->errors(),433);
          }
  
          
          foreach($data['users'] as $user){
            $data= new User;
            $data->name=$user['name'];
            $data->email=$user['email'];
            $data->password=bcrypt($user['password']);
            $data->save();
            $massage="user successfully added";
         }
         return response()->json(['massage'=>$massage],201);
        }
    }

    public function user_update(Request $request ,$id){
        if($request->isMethod('put')){
            $data =$request->all();
            //return $data;
            $rules=[
              'name'=>'required',
              'password'=>'required',
          ];
          $custommessage=[
              'name.required'=>'Name is required',
              'password.required'=>'password is required',
          ];
          $validator=Validator::make($data,$rules,$custommessage);
          if ($validator->fails()) {
              return response()->json($validator->errors(),422);
          }
  
          $user=User::findOrFail($id);
          $user->update([
              'name'=>$request->name,
              'password'=> bcrypt($request->password),
            ]);
            $massage="user updated successfully";
            return response()->json(['massage'=>$massage],202);
        }
    }

    public function single_update(Request $request ,$id){
        if($request->isMethod('patch')){
            $data =$request->all();
            //return $data;
            $rules=[
              'name'=>'required',
          ];
          $custommessage=[
              'name.required'=>'Name is required',
          ];
          $validator=Validator::make($data,$rules,$custommessage);
          if ($validator->fails()) {
              return response()->json($validator->errors(),422);
          }
  
          $user=User::findOrFail($id);
          $user->update([
              'name'=>$request->name,
            ]);
            $massage="single data updated successfully";
            return response()->json(['massage'=>$massage],202);
        }
    }
}
