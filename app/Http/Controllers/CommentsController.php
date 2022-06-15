<?php

namespace App\Http\Controllers;

use App\Models\CommentsModel;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
   public function addComments(Request $req)
   {
       $data = new CommentsModel();
       $data->person_id = $req->input('person_id');
       $data->post_id = $req->input('post_id');
       $data->comments = $req->input('comments');
       $data->isPublished = 0;
       $data->save();
       return $data;
   }

//    Getting and send
   public function getComments($id)
   {
       return CommentsModel::where("post_id",$id)->get();
   }
   public function delComments(Request $req)
   {
       $data = CommentsModel::find($req->input('id'));
       $data->delete();
       return ['Item'=>"deleted"];
   }
}
