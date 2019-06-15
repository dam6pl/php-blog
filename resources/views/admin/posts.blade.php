@extends('admin.layout')

@section('content')
    <div class="container mt-5 pt-5">
        <a href="{{ url('admin/posts/0') }}"
           class="btn btn-primary float-right mb-3">Dodaj nowy post</a>
        <table class="table table-bordered posts-list">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tytuł</th>
                <th scope="col">Autor</th>
                <th scope="col">Utworzono</th>
                <th scope="col">Ostatnia modyfikacja</th>
                <th scope="col">Zarządzaj</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <th scope="row">{{ $post->id }}</th>
                    <td>
                        <a href="{{ url("posts/{$post->id}") }}">
                            {{ $post->title }}
                        </a>
                    </td>
                    <td>{{ "{$post->author->display_name} ({$post->author->login})" }}</td>
                    <td>{{ $post->created_at }}</td>
                    <td>{{ $post->modified_at ?? $post->created_at}}</td>
                    <td class="actions">
                        @if (\App\User::isAdmin() || auth()->user()->login === $post->author->login)
                            <a href="{{ url("admin/posts/{$post->id}") }}">
                                <span class="fa-stack fa-sm">
                                    <i class="fas fa-edit fa-stack-1x"></i>
                                </span>
                            </a>
                            <form action="{{ url("admin/posts/{$post->id}/delete") }}" method="post"
                                  onsubmit="return confirm('Jeśli usuniesz post, zostaną usunięte wszystkie przypisane ' +
                               'do niego komentarze. Jesteś tego pewien?');">
                                @csrf
                                <input type="text" name="action" title="action" value="action_remove_post" hidden>
                                <input type="text" name="post_id" title="post_id" value="{{ $post->id }}" hidden>
                                <button type="submit">
                                <span class="fa-stack fa-sm">
                                    <i class="fas fa-trash-alt fa-stack-1x"></i>
                                </span>
                                </button>
                            </form>
                        @else
                            <span class="fa-stack fa-sm">
                                <i class="fas fa-times fa-stack-1x"></i>
                            </span>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection