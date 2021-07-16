@extends('front.layouts.master')
@section('title', $article->getCategory->name)
@section('article_title',$article->title)
@section('bg', asset($article->image))
@section('content')

                <div class="col-md-9 ">
                   {!! $article->content !!}<br>
                    <span class="badge bg-primary mb-4">Okunma Sayısı: {{$article->hit}}</span>
                </div>

    @include('front.widgets.categorywidget')
@endsection
