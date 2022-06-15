<?php

namespace App\Http\Controllers;

use App\Models\ClientModal;
use App\Models\PostModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function user(Request $request)
    {
        $data1 = $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required'
        ]);
        $data = new User;
        if($data1){
            $data->name = $request->input('name');
            $data->email = $request->input('email');
            $data->password = Hash::make($request->input('passowrd'));
            $data->save();
            return $data;
        }
       return ["error"=>"Error is assigned"];
    }
    public function posts(Request $req)
    {  
       $data = new PostModel;
       
    //    $req1 = $req->validate([
    //     'title'=>'required',
    //     'price'=>'nullable',
    //     'file'=>'required'
    // ]);

        $data->title = $req->input('title');
        $data->price = $req->input('price');
        $data->c_id = $req->input('id');
        $data->description = $req->input('desc');
        $data->isAllowed = 0;
        $data->countLiked = 0;
        $data->countDisLiked = 0;
        $data->category = $req->input('category');
        $data->img_path = $req->file('file')->store('fayls');
        $data->save();
        return $data;
   
//    return ["error"=>"Error is assigned"];
    }
    public function data()
    {
        $types = PostModel::orderByDesc('id')->limit(15)->get();
        return $types;
    }
    public function login(Request $req)
    {
        //  Login qilish zarur
        $email = $req->input('email');
        $password = $req->input('password');
        $user  = User::where('email',$email)->first();
        if($user || Hash::check($password,$user->password)){
            return $user;
        }
        return ['error'=>'invalid password'];
    }

    public function client(Request $req)
    {
        $person = new ClientModal;
        $person->name = $req->input('name');
        $person->email = $req->input('email');
        $person->address = $req->input('address');
        $person->contact = $req->input('contact');
        $person->id = $req->input('id');
        $person->save();
       return $person;
    }
}
