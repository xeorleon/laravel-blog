@extends('back.layouts.master')
@section('title','Tüm Sayfalar')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <span class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"><strong>@yield('title')</strong> </h6>
                <h6 class="m-0 font-weight-bold text-primary"><strong>{{$pages->count()}} sayfa bulundu.</strong>
                </h6>
            </span>

        </div>
        <div class="card-body">
            <div id="orderSuccess" class="alert alert-success" style="display:none;">Sıralama güncellendi</div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Sıralama</th>
                        <th>Fotoğraf</th>
                        <th>Sayfa Adı</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tbody id="orders">
                    @foreach($pages as $page)
                        <tr id="page_{{$page->id}}">
                            <td class="text-center "><i class="fas fa-arrows-alt fa-2x handle" style="cursor:move; cursor: -webkit-grabbing;"></i></td>
                            <td>
                                <img src="{{asset($page->image)}}" class="img-fluid" width="200">
                            </td>
                            <td>{{$page->title}}</td>
                            <td><input type="checkbox"
                                       data-on="Aktif" data-off="Pasif"
                                       data-onstyle="success" data-offstyle="warning"
                                       data-page-id="{{$page->id}}"
                                       @if($page->status == 1) checked @endif data-toggle="toggle"
                                       class="switch">
                            </td>
                            <td class="d-inline-flex justify-content-between">
                                <a href="{{route('page' ,$page->slug )}}" target="_blank" title="Görüntüle" class="btn btn-sm btn-success mr-2"><i
                                        class="fa fa-sm fa-eye"></i></a>
                                <a href="{{route('admin.page.edit', $page->id)}}" title="Düzenle"
                                   class="btn btn-sm btn-primary mr-2"><i
                                        class="fa fa-sm fa-pen"></i></a>

                                <a title="Sil" href="{{route('admin.page.delete',$page->id)}}" class="btn btn-sm btn-danger"><i
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
    <link href="{{asset('back/')}}/css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
          rel="stylesheet">

@endsection
@section('extra-js')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script src="{{asset('back/')}}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('back/')}}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="{{asset('back/')}}/js/demo/datatables-demo.js"></script>
    <script>
        /*SortableJS*/
        $('#orders').sortable({
            handle: '.handle',
            ghostClass:'.opacity-4',
            update: function(){
                var siralama = $('#orders').sortable('serialize');
                $.get("{{route('admin.page.orders')}}?"+siralama,function(data,status){
                    $('#orderSuccess').show().delay(1000).fadeOut();
                });
            },
        })
    </script>
    <script>
        /* Switch Toggle */
        $(function () {
            $('.switch').change(function () {
                id = $(this).data('page-id');
                status = $(this).prop('checked');
                $.get("{{route('admin.page.switch')}}", {id: id, status: status}, function (data, status) {

                })
            })
        })
    </script>

@endsection
