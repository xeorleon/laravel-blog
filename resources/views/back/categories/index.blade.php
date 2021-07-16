@extends('back.layouts.master')
@section('title','Kategori İşlemleri')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Yeni Kategori Oluştur</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('admin.category.create')}}">
                        @csrf
                        <div class="form-group">
                            <label>Kategori Adı</label>
                            <input type="text" class="form-control" name="category" required/>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Ekle</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Kategori Adı</th>
                                <th>Makale Sayısı</th>
                                <th>Durum</th>
                                <th>İşlemler</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>

                                    <td>{{$category->name}}</td>
                                    <td>{{$category->articleCount()}}</td>
                                    <td><input type="checkbox"
                                               data-on="Aktif" data-off="Pasif"
                                               data-onstyle="success" data-offstyle="warning"
                                               data-category-id="{{$category->id}}"
                                               @if($category->status == 1) checked @endif data-toggle="toggle"
                                               class="switch">
                                    </td>
                                    <td class="d-inline-flex justify-content-between">
                                        <a href="{{route('category',$category->slug)}}"
                                           target="_blank" title="Görüntüle" class="btn btn-sm btn-success mr-2"><i
                                                class="fa fa-sm fa-eye"></i></a>
                                        <a title="Düzenle"
                                           data-category-id="{{$category->id}}"
                                           class="btn btn-sm btn-primary mr-2 edit-click"><i
                                                class="fa fa-sm fa-pen"></i></a>

                                        <a title="Sil" data-category-id="{{$category->id}}"
                                           data-category-count="{{$category->articleCount()}}"
                                           data-category-name="{{$category->name}}"
                                           class="btn btn-sm btn-danger delete-click"><i
                                                class="fa fa-sm fa-times"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Kategoriyi Düzenle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Kapat">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('admin.category.update')}}">
                        @csrf
                        <div class="form-group">
                            <label>Kategori Adı</label>
                            <input id="category" type="text" class="form-control" name="category"/>
                            <input type="hidden" name="id" id="category_id"/>
                        </div>
                        <div class="form-group">
                            <label>Kategori Slug</label>
                            <input id="slug" type="text" class="form-control" name="slug"/>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                    <button type="submit" class="btn btn-primary">Kaydet</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Kategoriyi Sil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Kapat">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body deleteModal-body">
                    <div class="articleAlert alert alert-danger">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                    <form method="post" action="{{route('admin.category.delete')}}">
                        @csrf
                        <input type="hidden" name="id" id="deleteCategoryId"/>
                        <button type="submit" id="deleteModal-button" class="btn btn-primary">Sil</button>
                    </form>
                </div>
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
            $('.delete-click').click(function () {
                id = $(this).data('category-id');
                count = $(this).data('category-count');
                name = $(this).data('category-name');
                if (id == 1) {
                    $('.articleAlert').html(name + ' kategorisi sabit kategoridir. Silinen diğer kategorilere ait makaleler bu kategoriye eklenecektir.');
                    $('.deleteModal-body').show();
                    $('#deleteModal-button').hide();
                    $('#deleteModal').modal();
                    return;
                }

                $('#deleteCategoryId').val(id);
                $('.deleteModal-body').hide();
                $('#deleteModal-button').show();
                if (count > 0) {
                    $('.deleteModal-body').show();
                    $('.articleAlert').html('Bu kategoriye ait ' + count + ' makale bulunmaktadır. Silmek istediğinize emin misiniz ?');
                }


                $('#deleteModal').modal();
            })
            $('.edit-click').click(function () {
                id = $(this).data('category-id');
                $.ajax({
                    type: 'GET',
                    url: '{{route('admin.category.getdata')}}',
                    data: {id: id},
                    success: function (data) {
                        $('#category').val(data.name)
                        $('#category_id').val(data.id)
                        $('#slug').val(data.slug)
                        $('#editModal').modal();
                    }
                })
            })

            $('.switch').change(function () {
                id = $(this).data('category-id');
                status = $(this).prop('checked');
                $.get("{{route('admin.category.switch')}}", {id: id, status: status}, function (data, status) {
                })
            })

        })
    </script>
@endsection
