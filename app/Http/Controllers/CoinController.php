<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class CoinController extends Controller
{
    public function index(){
        $coins = Coin::orderBy("updated_at","DESC")->paginate(25);
        return view("admin.coin.index",compact("coins"));
    }

    public function create()
    {
        return view("admin.coin.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "marketCap" => "required",
            "icon" => "required",
        ],[
            "name.required" => "Bu alan boş bırakılamaz.",
            "marketCap.required" => "Bu alan boş bırakılamaz.",
            "icon.required" => "Bu alan boş bırakılamaz.",
        ]);


        $coin = new Coin;
        $coin->name = $request->name;
        $coin->marketCap = $request->marketCap;
        $coin->votes = "0";

        if($request->file("icon")){
            $path = Storage::putFile('photos', new File($request->icon));
            $coin->icon = $path;
        }else{
            return redirect()-back()->withErrors("Lütfen bilgileri kontrol ediniz.");
        }

        $coin->promoted = $request->promoted == 1 ? true : false;
        $coin->save();

        return redirect()->back()->with("success","Coin başarılı bir şekilde oluşturuldu.");

    }

    public function edit($id)
    {
        $coin = Coin::where("id",$id)->firstOrFail();
        return view("admin.coin.update",compact("coin"));
    }

    public function update(Request $request,$id){

        $coin = Coin::findOrFail($id);
        $coin->name = $request->name;
        $coin->marketCap = $request->marketCap;

        if($request->file("icon")){
            if(Storage::path($coin->icon)){
                Storage::delete($coin->icon);
            }

            $path = Storage::putFile('photos', new File($request->icon));
            $coin->icon = $path;
        }

        $coin->promoted = $request->promoted == 1 ? true : false;
        $coin->save();

        return redirect()->back()->with("success","Coin başarılı bir şekilde güncellendi.");

    }

    public function destroy(Request $request){
        $coin = Coin::where("id",$request->id)->firstOrFail();
        if(Storage::path($coin->icon)){
            Storage::delete($coin->icon);
        }
        $coin->delete();
        return redirect()->back()->with("success","Coin başarılı bir şekilde silinmiştir.");
    }

}
