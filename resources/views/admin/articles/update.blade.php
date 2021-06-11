@extends('admin.layouts.master')
@section('title',$article->name.' Makalesini Güncelle')
@section('css')
@endsection
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
        </div>
        <div class="card-body">
            @if(Session::get("success"))
                <div class="alert alert-success">{{Session::get("success")}}</div>
            @endif
            @if($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">{{$error}}</div>
                @endforeach
            @endif
            <form action="{{url("/admin/articles/$article->id")}}" method="post" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                @error("title")
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
                <div class="form-group">
                    <label>Makale Başlığı</label>
                    <input type="text" name="title"  class="form-control" value="{{$article->title}}" required>
                </div>
                @error("category_id")
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
                <div class="form-group">
                    <label>Makale Kategorisi</label>
                    <select name="category_id" class="form-control">
                        @foreach($categories as $category)
                            @if($category->id == $article->category_id)
                                <option value="{{$category->id}}" selected>{{$category->name}}</option>
                            @else
                                <option value="{{$category->id}}" >{{$category->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                @error("image")
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">Yükle</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">Fotoğraf Seçiniz</label>
                    </div>
                </div>
                @error("content")
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
                <div class="form-group">
                    <label>Makale İçeriği</label><br>
                    <textarea name="content" id="editor" cols="30" rows="10" required>{!! $article->content!!}</textarea>
                </div>

                @error("keywords")
                <div class="alert alert-danger">{{$message}}</div>
                @enderror

                <label>Makale Keywordsleri</label>
                <div class="form-group">
                    <textarea name="keywords" class="form-control" cols="30" rows="10" required>{{$article->keywords}}</textarea>
                </div>

                @error("descriptions")
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
                <label>Makale Descriptionsları</label>
                <div class="form-group">
                    <textarea name="descriptions" class="form-control" cols="30" rows="10" required>{{$article->descriptions}}</textarea>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit">Coini Oluştur</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section("js")
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'editor' );
    </script>
@endsection
