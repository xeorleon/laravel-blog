@extends('front.layouts.master')
@section('title','Anasayfa')
@section('article_title','Anasayfa')
@section('content')
    <div class="col-md-9">
        @include('front.widgets.articlelist')
    </div>
    @include('front.widgets.categorywidget')
@endsection
