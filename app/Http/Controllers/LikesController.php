<?php

namespace App\Http\Controllers;

use App\Models\Likes;
use App\Models\PostModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LikesController extends Controller
{
   public function IsLiked(Request $req)
   {
       $likes =  new  Likes();
       $likes->p_id = $req->input('p_id');
       $likes->item_id = $req->input('item_id');
       $likes->isLiked = 1;
       $likes->save();
       return $likes;

   }

   public function NotLiked(Request $req)
   {
       $personal = Likes::where('p_id','=',$req->input('p_id'))->get();
       $personall = $personal->where('item_id',"=",$req->input('item_id'))->first();
    //    $personal = Likes::where('p_id','=',$req->input('p_id'),'and','item_id','=',$req->input('item_id'))->first();
       $personall->delete();
       return ["item"=>"deleted"];
    // return $personall;
   }

   public function AddLike($id)
   {
       $post = PostModel::find($id);
       $post->countLiked = $post->countLiked +1;
       $post->save();
       return $post;
   }


   public function RemoveLike($id)
   {
       $post = PostModel::find($id);
       $post->countDisLiked = $post->countDisLiked +1;
       $post->save();
       return $post;
   }

    // Filter by p_id likdePosts

    public function filterLiked($id)
    {
      $info = DB::table('likes_posts')
      ->leftJoin('posts', 'likes_posts.item_id', '=', 'posts.id')
      ->where('p_id',$id)
      ->get();

      return $info;
    }
    public function LikesPosts()
    {
        $types=DB::select("select posts.*,likes_posts.*, posts.id as pid, likes_posts.p_id as per_id from  posts left join likes_posts on posts.id = likes_posts.item_id");
        return $types;
    }
}
