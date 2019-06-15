@extends('blog.layout')

@section('content')
    <!-- Page Header -->
    <header class="masthead" style="background-image: url('{{ asset('images/home-bg.jpg') }}')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1>Blog podróżniczy dla ciekawych świata!</h1>
                        <span class="subheading">
                        Opisy wycieczek, subiektywne przewodniki, piękne zdjęcia i mnóstwo porad jak zaplanować własny wyjazd.
                    </span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                @foreach ($posts as $post)
                    <div class="post-preview">
                        <a href="{{ url("posts/{$post->id}") }}">
                            <h2 class="post-title">{{ $post->title }}</h2>
                            <h3 class="post-subtitle">
                                {!! @reset(preg_split('~[.?!]~', $post->content)) !!}
                            </h3>
                        </a>
                        <p class="post-meta">Opublikowany przez
                            <a href="#">{{ $post->author->display_name }}</a>
                            dnia {!! date('d M Y', strtotime($post->created_at)) !!}
                            o godzinie {!! date('H:i', strtotime($post->created_at)) !!}</p>
                    </div>
                    <hr>
                @endforeach

            </div>
        </div>
    </div>
@endsection