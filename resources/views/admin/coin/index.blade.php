@extends('admin.layouts.master')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><strong>{{$coins->count()}} Coin Bulunudu.</strong></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Coin İconu</th>
                        <th>Coin Adı</th>
                        <th>Coin Market Cap</th>
                        <th>Coin Votes</th>
                        <th>Coin Oluşturulma Tarihi</th>
                        <th>İşlemler</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($coins as $coin)
                        <tr>
                            <td>
                                <img src="{{$coin->icon}}" width="150" height="150" alt="">
                            </td>
                            <td>{{$coin->name}}</td>
                            <td>${{$coin->marketCap}}</td>
                            <td>{{$coin->votes}}</td>
                            <td>{{$coin->created_at->diffForHumans()}}</td>
                            <td style="display: flex; flex-wrap: nowrap;">
                                <a target="_blank" href="" title="Görüntüle" class="btn btn-sm btn-success mr-2"><i class="fa fa-eye"></i></a>
                                <a href="{{url("/admin/coins/$coin->id/edit")}}" title="Düzenle" class="btn btn-sm btn-primary mr-2"><i class="fa fa-pen"></i></a>
                                <form method="POST" action="{{url("/admin/coins/$coin->id")}}" title="Sil">
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

