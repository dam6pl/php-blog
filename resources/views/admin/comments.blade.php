@extends('admin.layout')

@section('content')
    <div class="container mt-5 pt-5">
        <table class="table table-bordered posts-list">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Autor</th>
                <th scope="col">Treść</th>
                <th scope="col">Post</th>
                <th scope="col">Data utworzenia</th>
                <th scope="col">Zarządzaj</th>
            </tr>
            </thead>
            <tbody>
            @foreach($comments as $comment)
                <tr>
                    <th scope="row">{{ $comment->id }}</th>
                    <td>{{ $comment->author }}</td>
                    <td>{{ $comment->content }}</td>
                    <td>
                        <a href="{{ url("posts/{$comment->post->id}") }}">
                            {{ $comment->post->title }}
                        </a>
                    </td>
                    <td>{{ $comment->created_at }}</td>

                    <td class="actions">
                        @if (\App\User::isAdmin() || auth()->user()->login === $comment->post->author->login)
                            <form action="{{ url("admin/comments/{$comment->id}/delete") }}" method="post"
                                  onsubmit="return confirm('Jeśli usuniesz użytkownika, zostaną usunięte wszystkie przypisane ' +
                               'do niego komentarze oraz posty. Jesteś tego pewien?');">
                                @csrf
                                <input type="text" name="action" title="action" value="action_remove_post" hidden>
                                <input type="text" name="post_id" title="post_id" value="{{ $comment->id }}" hidden>
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
