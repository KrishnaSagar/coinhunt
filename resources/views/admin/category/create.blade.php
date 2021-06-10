@extends('admin.layouts.master')
@section('title','Kategori Oluştur')
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
            <form action="{{url("/admin/categories")}}" method="post">
                @csrf
                @error("name")
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
                <div class="form-group">
                    <label>Kategori Adı</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                @error("keywords")
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
                <label>Kategori Keywordsleri</label>
                <div class="form-group">
                    <textarea name="keywords" class="form-control" cols="30" rows="10" required></textarea>
                </div>

                @error("descriptions")
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
                <label>Kategori Descriptionsları</label>
                <div class="form-group">
                    <textarea name="descriptions" class="form-control" cols="30" rows="10" required></textarea>
                </div>


                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit">Coini Oluştur</button>
                </div>
            </form>
        </div>
    </div>
@endsection
