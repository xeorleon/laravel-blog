@extends('back.layouts.master')
@section('title','Silinen Makaleler')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <span class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"><strong>@yield('title')</strong> </h6>
                <h6 class="m-0 font-weight-bold text-primary"><strong>{{$articles->count()}} makale bulundu.</strong>
                <a href="{{route('admin.makaleler.index')}}" class="btn btn-primary btn-sm">Aktif Makaleler</a>
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
                        <th>Silinme Tarihi</th>
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
                            <td>{{$article->deleted_at->diffForHumans()}}</td>
                            <td>
                                <a title="Makaleyi Kurtar" href="{{route('admin.recover.article', $article->id)}}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-sm fa-recycle"></i>
                                </a>
                                <a title="Sil" href="{{route('admin.hard.delete.article',$article->id)}}" class="btn btn-sm btn-danger">
                                    <i class="fa fa-sm fa-times"></i>
                                </a>
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
