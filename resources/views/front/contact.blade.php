@extends('front.layouts.master')
@section('title', 'İletişim')
@section('article_title','İletişim')
@section('bg', 'https://startbootstrap.github.io/startbootstrap-clean-blog/assets/img/contact-bg.jpg')
@section('content')
    <main class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-8">
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{session('success')}}
                        </div>
                    @endif
                    @if($errors->any())

                        <div class="alert alert-danger" role="alert">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>
                                        {{$error}}
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    @endif
                    <p>Bizimle iletişime geçebilirsiniz.</p>
                    <div class="my-5">
                        <form id="contactForm" action="{{route('contact.post')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Ad Soyad</label>
                                <input class="form-control" value="{{old('name')}}" name="name" type="text" required/>
                            </div>
                            <div class="form-group">
                                <label for="email">Email adresi</label>

                                <input class="form-control" name="email" value="{{old('email')}}" type="email"
                                       required/>

                            </div>
                            <div class="form-group">
                                <label for="topic">Konu</label>
                                <select class="form-control" name="topic" required>
                                    <option @if(old('topic') == 'Bilgi') selected @endif>Bilgi</option>
                                    <option @if(old('topic') == 'Destek') selected @endif>Destek</option>
                                    <option @if(old('topic') == 'Genel') selected @endif>Genel</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="message">Mesajınız</label>
                                <textarea class="form-control" name="message" required
                                          style="height: 12rem">{{old('message')}}</textarea>
                            </div>
                            <br>
                            <button class="btn btn-primary text-uppercase" id="submitButton" type="submit">
                                Gönder
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-group">
                        <div class="card card-default">
                            <div class="card-body">
                                Card Content
                            </div>
                            Adres:Bla Bla Bla
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
