
@extends('admin.layouts.master')
@section('title',$coin->name.' Coinini Güncelle')
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
            <form action="{{url("/admin/coins/$coin->id")}}" method="post" enctype="multipart/form-data">
                @method("put")
                @csrf
                @error("name")
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
                <div class="form-group">
                    <label>Coin Adı</label>
                    <input type="text" name="name" class="form-control" value="{{$coin->name}}">
                </div>
                @error("icon")
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">Yükle</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" name="icon" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">İcon Seçiniz</label>
                    </div>
                </div>
                @error("marketCap")
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
                <div class="form-group">
                    <label>Coin MarketCap</label>
                    <input name="marketCap" type="text" class="form-control" value="{{$coin->marketCap}}">
                </div>
                <div class="form-group">
                    <label>Coin Votes</label>
                    <input name="votes" type="text" class="form-control" value="{{$coin->votes}}" readonly>
                </div>
                @error("promoted")
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
                <div class="form-group">
                    <label>Is Coin Promoted </label>
                    <select name="promoted" class="form-control">
                        @if($coin->promoted == 1)
                            <option value="1" selected>Yes</option>
                            <option value="0">No</option>
                        @else
                            <option value="0" selected>No</option>
                            <option value="1">Yes</option>
                        @endif
                    </select>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit">Coini Oluştur</button>
                </div>
            </form>
        </div>
    </div>
@endsection
