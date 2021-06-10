<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\File;

class ArticleController extends Controller
{
    public function index(){
        $articles = Article::orderBy("id","DESC")->get();
        return view("admin.articles.index",compact("articles"));
    }

    public function create(){
        $category = Category::orderBy("id","DESC")->get();
        return view("admin.articles.create", compact("category"));
    }

    public function store(Request $request){
        $request->validate([
            "title" => "required",
            "category_id" => "required",
            "image" => "required",
            "content" => "required",
            "keywords" => "required",
            "descriptions" => "required",
        ],[
            "title.required" => "Lütfen alanları eksiksiz doldurunuz.",
            "category_id.required" => "Lütfen alanları eksiksiz doldurunuz.",
            "image.required" => "Lütfen alanları eksiksiz doldurunuz.",
            "content.required" => "Lütfen alanları eksiksiz doldurunuz.",
            "keywords.required" => "Lütfen alanları eksiksiz doldurunuz.",
            "descriptions.required" => "Lütfen alanları eksiksiz doldurunuz.",
        ]);

        $article = new Article;
        $article->title = $request->title;
        $article->category_id = $request->category_id;
        $article->content = $request->content;
        $article->keywords = $request->keywords;
        $article->slug = Str::slug($request->title);
        $article->summary = Str::substr($request->content, 0, 100);;
        $article->descriptions = $request->descriptions;
        if($request->file("image")){
            $path = Storage::putFile('articles', new File($request->image));
            $article->image = $path;
        }else{
            return redirect()->back()->withErrors("Lütfen bilgileri kontrol ediniz.");
        }

        $article->save();

        return redirect("/admin/articles")->with("success","Makale başarılı bir şekilde oluşturulmuştur.");

    }

    public function edit(){

    }

    public function update(){

    }

    public function destroy(){

    }
}
