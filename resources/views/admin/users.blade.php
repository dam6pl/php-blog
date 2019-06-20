@extends('admin.layout')

@section('content')
    <div class="container mt-5 pt-5">
        <table class="table table-bordered posts-list">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Login</th>
                <th scope="col">Użytkownik</th>
                <th scope="col">Data rejestracji</th>
                <th scope="col">Rola</th>
                <th scope="col">Zarządzaj</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->login }}</td>
                    <td>{{ "{$user->display_name} " }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ ($user->is_admin) ? 'Administrator' : 'Użytkownik'}}</td>
                    <td class="actions">
                        @if (\App\User::isAdmin() || auth()->user()->login === $user->author->login)

                            <form action="{{ url("admin/users/{$user->id}/delete") }}" method="post"
                                  onsubmit="return confirm('Jeśli usuniesz użytkownika, zostaną usunięte wszystkie przypisane ' +
                               'do niego komentarze oraz posty. Jesteś tego pewien?');">
                                @csrf
                                <input type="text" name="action" title="action" value="action_remove_post" hidden>
                                <input type="text" name="post_id" title="post_id" value="{{ $user->id }}" hidden>
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
