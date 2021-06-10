@extends('admin.layouts.master')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><strong>{{$categories->count()}} Kategori Bulunudu.</strong></h6>
        </div>
        <div class="card-body">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">{{$error}}</div>
                @endforeach
            @endif
            @if(Session::get("success"))
                <div class="alert alert-success">{{Session::get("success")}}</div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Kateogri ID</th>
                        <th>Kategori Adı</th>
                        <th>Kategoriye Ait Makale Sayısı</th>
                        <th>Kategori Oluşturulma Tarihi</th>
                        <th>İşlemler</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td>{{$category->getArticles()->count()}}</td>
                            <td>{{$category->created_at->diffForHumans()}}</td>
                            <td style="display: flex; flex-wrap: nowrap;">
                                <a target="_blank" href="" title="Görüntüle" class="btn btn-sm btn-success mr-2"><i class="fa fa-eye"></i></a>
                                <a href="{{url("/admin/categories/$category->id/edit")}}" title="Düzenle" class="btn btn-sm btn-primary mr-2"><i class="fa fa-pen"></i></a>
                                <form method="POST" action="{{url("/admin/categories/$category->id")}}" title="Sil">
                                    @csrf
                                    @method("delete")
                                    <button class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

