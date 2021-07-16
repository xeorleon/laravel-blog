@extends('back.layouts.master')
@section('title',$page->title.' Sayfasını Güncelle')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <span class="d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"><strong>@yield('title')</strong> </h6>
            </span>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                    @foreach($errors->all() as $error)
                       <li> {{$error}}</li>
                    @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="{{route('admin.page.edit.post', $page->id)}}" enctype="multipart/form-data">

                @csrf
                <div class="form-group">
                    <label>Sayfa Başlığı</label>
                    <input type="text" name="title" class="form-control" required value="{{$page->title}}"/>
                </div>
                <div class="form-group">
                    <label class="mb-2">Sayfa Fotoğrafı</label><br>
                    <img src="{{asset($page->image)}}" class="img-fluid rounded mb-2" style="width: 30%"/>
                    <input type="file" name="image" class="form-control"/>
                </div>
                <div class="form-group">
                    <label>Sayfa İçerik</label>
                    <textarea class="form-control" id="editor" name="content" rows="12" required>
                        {!! $page->content !!}
                    </textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Makaleyi Güncelle</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('extra-css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('extra-js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#editor').summernote({
                tabSize: 2,
                height: 300,
            });
        });
    </script>
@endsection
