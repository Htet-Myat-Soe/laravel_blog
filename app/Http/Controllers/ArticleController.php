<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Article;
use App\Models\Category;

class ArticleController extends Controller
{
    public function __construct(){
        $this->middleware("auth")->except(["index","details"]);
    }
    public function index(){
        $data = Article::latest()->paginate(5);
        // $data = Article::all();
        return view("articles.index",["articles" => $data]);
    }

    public function details($id){
        $data = Article::find($id);
        return view("articles.details",["article" => $data]);
    }

    public function delete($id){
        $data = Article::find($id);
        $data->delete();
        return redirect()->route("articles.index")->with(["delete_success" => "Deleted Successfully"]);
    }

    public function add(){
        $data = Category::all();
        return view("articles.create",["categories" => $data]);
    }

    public function create(Request $req){
        $validator = validator($req->all(),[
            "title" => "required",
            "body" => "required",
            "category_id" => "required",
        ]);

        if($validator->fails()){
            return back()->with(["create_fail" => "fill all of field"]);
        }

        $article = new Article;
        $article->title = $req->title;
        $article->body = $req->body;
        $article->category_id = $req->category_id;
        $article->user_id = $req->user_id;
        $article->save();
        return redirect()->route("articles.index")->with(["create_success" => "Article Created Successfully !"]);
    }
}
