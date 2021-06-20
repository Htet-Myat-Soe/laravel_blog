<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Gate;
class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    public function add_cmt(Request $req){
        $comment = new Comment;
        $validator = validator($req->all(),[
            "comment" => "required",
        ]);
        if($validator->fails()){
            return back()->with(["cmt_required" => "Please suggest something !"]);
        }
        $comment->comment = $req->comment;
        $comment->article_id = $req->article_id;
        $comment->user_id = $req->user_id;
        $comment->save();
        return back();
    }

    public function delete($id){
        $data = Comment::find($id);


        if(Gate::allows('comment-delete',$data)){
            $data->delete();
            return back();
        }
        else{
            return back()->with(["unauth" => "UnAuthorization user"]);
        }
    }
}
