<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
}
