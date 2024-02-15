@extends('layouts.master')

@section('title')
    @if(isset($title))
        - {{ $title }}
    @endif
@endsection

@section('content')
    <section class="pb-1 mb-1 dt-front-page-welcome">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-1 mb-lg-0">
                    <h2 class="text-uppercase dt-page-intro-header">KATEGORIE POLECANYCH FILMÓW Z <span class="text-primary">Youtube</span></h2>
                    <span class="text-muted text-uppercase dt-text-small dt-page-intro-subheader">Filmy, które warto zobaczyć</span>
                    <div class="dt-hr dt-page-intro-rule"></div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="mt-0 col-xs-12 col-md-9 single-video-left">
                    @if(session()->get('success') OR session()->get('error'))
                        <div class="mt-5 mb-5">
                            @if(session()->get('success'))
                                <div class="alert alert-success mb-3">
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                            @if(session()->get('error'))
                                <div class="alert alert-error mb-3">
                                    {{ session()->get('error') }}
                                </div>
                            @endif
                        </div>
                    @endif
                    @auth
                        <a class="btn btn-success" href="{{ route('youtube.create') }}">Dodaj nową kategorię</a>
                        <a class="ml-3 btn btn-success" href="{{ route('filmy.create') }}">Dodaj nowy film</a>
                    @endauth

                    <div class="mt-3 mb-3">
                        {{ $categories->links() }}
                    </div>
                    {{--@foreach ($categories as $category)--}}
                    @foreach ($categoriesOrderByName as $category)
                        <div>
                            <a class="mt-3 mb-3" href="{{ route('youtube.show', $category->id) }}"><h3 class="text-uppercase">{!! $category->name !!}</h3></a>
                            <p>{!! $category->description !!}
                            <br>Liczba filmów: {{$category->films_count}}.</p>
                            @auth
                                <div class="mt-3">
                                    <form action="{{ route('youtube.destroy', $category->id) }}" method="POST">
                                        <a class="btn btn-primary" href="{{ route('youtube.edit', $category->id) }}">Edycja</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger ml-5" onclick="return confirm('Czy na pewno usunąć?')">Usuń</button>
                                    </form>
                                </div>
                            @endauth
                            <hr class="mr-5">
                        </div>
                    @endforeach
                    <div class="mt-5 mb-5">
                        {{ $categories->links() }}
                    </div>

                    <div class="mt-5 mb-5">
                        <a class="btn btn-primary" href="{{ route('filmy.index') }}">Lista wszystkich filmów (alfabetycznie)</a>
                    </div>
                </div>
                <!-- right col. -->
                <div class="col-xs-12 col-md-3 single-video-right">
                    <!-- pojedynczy box -->
                    <div class="card">
                        <div class="right-col-box categories-box">
                            <h4>Popularne kategorie</h4>
                            <ul class="list-group">
                                @foreach ($categoriesOrderByFilmsCount as $PopCategory)
                                    <li class="list-group-item">
                                        <h5><a class="mt-3 mb-3" href="{{ route('youtube.show', $PopCategory->id) }}">{{ $PopCategory->name }}</a></h5>
                                        <span>(liczba filmów: <b>{{ $PopCategory->films_count }}</b>)</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- pojedynczy box -->
                    <div class="card">
                        <div class="right-col-box">
                            <h4>Statystyki</h4>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    {{--<a class="" href="{{ route('filmy.index') }}">Wszystkich filmów</a> : <span class="badge">{{ $filmCount }}</span>--}}
                                    Wszystkich filmów : <span class="badge">{{ $filmCount }}</span>
                                </li>
                                <li class="list-group-item">
                                    {{--<a class="" href="{{ route('youtube.index') }}">Wszystkich kategorii</a> : <span class="badge">{{ $categoryCount }}</span>--}}
                                    Wszystkich kategorii : <span class="badge">{{ $categoryCount }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- end right col. -->
            </div>
        </div>
    </section>

@endsection
