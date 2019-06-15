@extends('admin.layout')

<?php $id = $post->id ?? 0; ?>

@section('content')
    <div class="container mt-5 pt-5">
        <form method="POST" action="{{ url("admin/posts/{$id}/update") }}" id="single-post-edit">
            @csrf
            <input type="text" name="action" title="action" value="action_save_post" hidden>
            <input type="text" name="post_id" title="post_id" value="{{ $post->id ?? 0 }}" hidden>
            <div class="form-group">
                <label for="title">Tytuł postu</label>
                <input type="text" class="form-control" name="title" value="{{ $post->title ?? '' }}" required>
            </div>
            <div class="form-group">
                <label for="content">Treść postu</label>
                <textarea class="form-control" name="content" id="visual-content" rows="10" required
                          style="opacity: 0">{!! $post->content ?? '' !!}</textarea>
            </div>
            <div class="form-group">
                <label for="image">Zdjęcie postu</label>
                <input type="url" class="form-control" name="image" value="{{ $post->image_url ?? '' }}" required>
            </div>

            <button type="submit" class="btn btn-primary float-right">Zapisz post</button>
        </form>
    </div>
@endsection