<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::orderBy("id","DESC")->get();
        return view("admin.category.index",compact("categories"));
    }

    public function create(){
        return view("admin.category.create");
    }

    public function store(Request $request){
        $request->validate([
            "name"=>"required",
            "keywords"=>"required",
            "descriptions"=>"required",
        ],[
            "name.required" => "Kateogori ismi boş bırakılamaz.",
            "descriptions.required" => "SEO çalışmaları için descriptions alanı boş bırakılamaz.",
            "keywords.required" => "SEO çalışmaları için keywords alanı boş bırakılamaz."
        ]);

        $exist = Category::where("slug",Str::slug($request->name))->first();

        if($exist){
            return redirect()->back()->withErrors("Zaten böyle bir kategori var.");
        }

        $category = new Category;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->keywords = $request->keywords;
        $category->descriptions = $request->descriptions;
        if($request->status){
            $category->status = $request->status;
        }
        $category->save();

        return redirect("/admin/categories")->with("success","Kategori başarılı bir şekilde oluşturulmuştur.");
    }

    public function edit($id){
        $category = Category::findOrFail($id);
        return view("admin.category.update",compact("category"));
    }

    public function update(Request $request){
        $request->validate([
            "name" => "required"
        ],[
            "name.required" => "Lütfen alanları eksiksiz doldurunuz."
        ]);

        $exist = Category::where("slug",Str::slug($request->name))->first();
        if($exist){
            return redirect()->back()->withErrors("Zaten böyle bir kategori var.");
        }

        $category = Category::findOrFail($request->id);
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->save();

        return redirect("/admin/categories")->with("success","Kategori başarılı bir şekilde güncellendi.");
    }

    public function destroy(Request $request){
        $category = Category::findOrFail($request->id);
        if($category->id == 1){
            return redirect()->back()->withErrors("Bir numaralı kategori silinemez.");
        }

        if($category->getArticles()->count() > 0 ) {
            Article::where('category_id', $category->id)->update(['category_id' => 1]);
            $success_text = "Bu kategorideki makaleler bir numaralı kategoriye aktarılmıştır.";
        }else{
            $success_text = "Kategori başarılı bir şekilde silindi.";
        }
        $category->delete();
        return redirect()->back()->with("success",$success_text);
    }
}
