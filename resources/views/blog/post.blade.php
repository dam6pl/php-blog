@extends('blog.layout')

@section('content')
    <!-- Page Header -->
    <header class="masthead" style="background-image: url('<?= $post['image_url']; ?>')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="post-heading">
                        <h1>{{ $post->title }}</h1>
                        <span class="meta">Opublikowany przez
                        <a href="#"><a href="#">{{ $post->author->display_name }}</a>
                            dnia {!! date('d M Y', strtotime($post->created_at)) !!}
                            o godzinie {!! date('H:i', strtotime($post->created_at)) !!}</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Post Content -->
    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    {!! $post->content !!}
                </div>
            </div>
        </div>
    </article>

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <h2>Komentarze</h2>
                <div class="row">
                    @foreach($comments as $comment)
                        <div class="col-12 my-3">
                            <h6>{{ $comment->author }} dnia {!! date('d M Y', strtotime($comment->created_at)) !!}
                                o godzinie {!! date('H:i', strtotime($comment->created_at)) !!} napisał: </h6>
                            <p>{{ $comment->content }}</p>
                            <hr/>
                        </div>
                    @endforeach
                </div>
                <div class="mt-3">
                    <h4>Dodaj nowy komentarz</h4>
                    <form method="post" action="{{ url("posts/{$post->id}") }}">
                        {{ csrf_field() }}
                        <input type="text" name="action" title="action" value="action_add_comment" hidden>
                        <input type="text" name="post_id" title="post_id" value="{{ $post->id }}" hidden>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls">
                                <label>Imie</label>
                                <input type="text" class="form-control" placeholder="Imie" name="name" required
                                       data-validation-required-message="Please enter your name.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls">
                                <label>Wiadomość</label>
                                <textarea rows="5" class="form-control" placeholder="Wiadomość" name="message" required
                                          data-validation-required-message="Please enter a message."></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" id="sendMessageButton">Wyślij</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection