@extends('back.layouts.master')
@section('title','Tüm Makaleler')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <span class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"><strong>@yield('title')</strong> </h6>
                <h6 class="m-0 font-weight-bold text-primary"><strong>{{$articles->count()}} makale bulundu.</strong>
                <a href="{{route('admin.trashed.article')}}" class="btn btn-warning btn-sm"><i class="fa fa-trash"></i> Silinen Makaleler</a>
                </h6>
            </span>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Fotoğraf</th>
                        <th>Makale Başlığı</th>
                        <th>Kategori</th>
                        <th>Hit</th>
                        <th>Oluşturulma Tarihi</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tbody>
                    @foreach($articles as $article)
                        <tr>
                            <td>
                                <img src="{{asset($article->image)}}" class="img-fluid" width="200">
                            </td>
                            <td>{{$article->title}}</td>
                            <td>{{$article->getCategory->name}}</td>
                            <td>{{$article->hit}}</td>
                            <td>{{$article->created_at->diffForHumans()}}</td>
                            <td><input type="checkbox"
                                       data-on="Aktif" data-off="Pasif"
                                       data-onstyle="success" data-offstyle="warning"
                                       data-article-id="{{$article->id}}"
                                       @if($article->status == 1) checked @endif data-toggle="toggle"
                                       class="switch">
                            </td>
                            <td class="d-inline-flex justify-content-between">
                                <a href="{{route('single',[$article->getCategory->slug,$article->slug])}}" target="_blank" title="Görüntüle" class="btn btn-sm btn-success mr-2"><i
                                        class="fa fa-sm fa-eye"></i></a>
                                <a href="{{route('admin.makaleler.edit', $article->id)}}" title="Düzenle"
                                   class="btn btn-sm btn-primary mr-2"><i
                                        class="fa fa-sm fa-pen"></i></a>

                                <a title="Sil" href="{{route('admin.delete.article',$article->id)}}" class="btn btn-sm btn-danger"><i
                                        class="fa fa-sm fa-times"></i></a>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('extra-css')
    <link href="{{asset('back/')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
          rel="stylesheet">

@endsection
@section('extra-js')
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script src="{{asset('back/')}}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('back/')}}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="{{asset('back/')}}/js/demo/datatables-demo.js"></script>
    <script>
        $(function () {
            $('.switch').change(function () {
                id = $(this).data('article-id');
                status = $(this).prop('checked');
                $.get("{{route('admin.switch')}}", {id: id, status: status}, function (data, status) {
                })
            })
        })
    </script>
@endsection
