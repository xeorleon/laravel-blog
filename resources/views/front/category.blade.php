@extends('front.layouts.master')
@section('title', $category->name)
@section('article_title', $category->name )
@section('content')
    <!-- Main Content-->

    <div class="col-md-9">
        @include('front.widgets.articlelist')
    </div>

    @include('front.widgets.categorywidget')
@endsection
