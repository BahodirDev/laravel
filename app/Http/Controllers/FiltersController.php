<?php

namespace App\Http\Controllers;

use App\Models\PostModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class FiltersController extends Controller
{
    public function filters($name)
    {
        $data = DB::select("select * from posts where title like '%".$name."%'");
        return $data;        
    }
    public function findPlace($id)
    {
       $data = DB::table('posts')
       ->leftJoin('clients', 'posts.c_id', '=','clients.id')
       ->where('address',$id)
       ->get();
        return $data;
    }
    public function sortPrice(Request $req)
    {
        if($req->input('Category') != ''){
           $data = DB::table('posts')->where("price","<",intval($req->input("MoneyTo")))->where("price",">",intval($req->input("MoneyFrom")))->where("category","=",$req->input('Category'))->get();
        }else{
            $data = DB::table('posts')->where("price","<",intval($req->input("MoneyTo")))->where("price",">",intval($req->input("MoneyFrom")))->get();
            
        }
        // $data = PostModel::where("price",">",$req->input("MoneyFrom"),"and","price","<",$req->input("MoneyTo"))->get();
         return $data;
    }
}
