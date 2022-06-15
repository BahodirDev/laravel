<?php

namespace App\Http\Controllers;

use App\Models\ClientModal;
use App\Models\PostModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function info()
    {
        $info = DB::table('clients')
        ->leftJoin('posts', 'clients.id', '=', 'posts.c_id')
        ->get();

        return $info;
    }
    public function detail($id)
    {
        $info = DB::table('clients')
        ->leftJoin('posts', 'clients.id', '=', 'posts.c_id')
        ->where('c_id',$id)
        ->get();

        return $info;
    }
    public function all()
    {
        $info = DB::table('clients')
        ->leftJoin('posts', 'clients.id', '=', 'posts.c_id')
        ->get();
        return $info;
    }
    public function update($id)
    {
    //    $user = DB::table('posts')->find($id);
     $user = PostModel::findOrFail($id);
       $user->isAllowed  = '1';
       $user->save();
    // //    $user->update($user);

       return $user->all();
    }
    
    public function update2($id)
    {
    //    $user = DB::table('posts')->find($id);
     $user = PostModel::findOrFail($id);
       $user->isAllowed  = '0';
       $user->save();
    // //    $user->update($user);

       return $user->all();
    }

    // public function unLiked($id)
    // {
    // //    $user = DB::table('posts')->find($id);
    //  $user = PostModel::findOrFail($id);
    //    $user->isLiked  = '0';
    //    $user->save();
    //    return $user;
    // }
    // public function Liked($id)
    // {
    // //    $user = DB::table('posts')->find($id);
    //  $user = PostModel::findOrFail($id);
    //    $user->isLiked  = '1';
    //    $user->save();
    //    return $user;
    // }
    
    public function delete($id)
    {
     $data = PostModel::where("c_id","=",$id);
     $user = ClientModal::find($id);
     $user->delete();
     $data->delete();
    return ['ITEM'=>"DELETED"];
    }

}
