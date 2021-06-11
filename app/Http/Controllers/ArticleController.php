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
        $article->summary = Str::limit($request->content, 100);
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

    public function edit($id){
        $article = Article::findOrFail($id);
        $categories = Category::orderBy("id","DESC")->get();

        return view("admin.articles.update",compact("article","categories"));
    }

    public function update(Request $request,$id){

        $article = Article::findOrFail($id);

        if($request->file("image")){
            if(Storage::path($article->image)){
                Storage::delete($article->image);
            }
            $path = Storage::putFile("articles",new File($request->image));
            $article->image = $path;
        }

        $article->title = $request->title;
        $article->content = $request->content;
        $article->category_id = $request->category_id;
        $article->slug = Str::slug($request->title);
        $article->keywords = $request->keywords;
        $article->descriptions = $request->descriptions;
        $article->summary = Str::substr($request->content,0,100);
        $article->save();

        return redirect("/admin/articles")->with("success","Makale başarılı bir şekilde güncellenmiştir.");

    }

    public function destroy(Request $request){
        $article = Article::findOrFail($request->id);
        if(Storage::path($article->image)){
            Storage::delete($article->image);
        }
        $article->delete();

        return redirect()->back()->with("success","Makale başarılı bir şekilde silindi");
    }
}
