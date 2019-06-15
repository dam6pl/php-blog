@extends('admin.layout')

@section('content')
    <div class="container">
        <div class="col-lg-4 offset-lg-4 mt-5 login-form">
            <div class="main-div pt-5">
                <form method="post" action="{{ route('login') }}">
                    @csrf
                    <input type="text" name="action" title="action" value="action_login" hidden>
                    <div class="form-group floating-label-form-group controls">
                        <label>Login</label>
                        <input type="text" class="form-control" name="login" placeholder="Login">
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="form-group floating-label-form-group mt-4 controls">
                        <label>Hasło</label>
                        <input type="password" class="form-control" name="password" placeholder="Hasło">
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="create-account my-4">
                        <span>Nie masz konta?</span> <a href="{{ url('register') }}">Utwórz konto!</a>
                    </div>
                    <button type="submit" class="btn btn-primary">Zaloguj się</button>
                </form>
            </div>
        </div>
    </div>
@endsection
