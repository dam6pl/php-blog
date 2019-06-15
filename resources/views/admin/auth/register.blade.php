@extends('admin.layout')

@section('content')
    <div class="container">
        <div class="col-lg-4 offset-lg-4 mt-5 login-form">
            <div class="main-div">
                <div class="panel mb-5 pt-5">
                    <h2>Rejestracja</h2>
                </div>
                <form method="post" action="{{ route('register') }}">
                    @csrf
                    <input type="text" name="action" title="action" value="action_register_account" hidden>
                    <div class="form-group floating-label-form-group">
                        <label>Imie i nazwisko</label>
                        <input type="text" class="form-control" name="name" placeholder="Imie i nazwisko"
                               value="{{ old('name') }}">
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="form-group floating-label-form-group mt-4">
                        <label>Login</label>
                        <input type="text" class="form-control" name="login" placeholder="Login"
                               value="{{ old('login') }}">
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="form-group floating-label-form-group mt-4">
                        <label>Hasło</label>
                        <input type="password" class="form-control" name="password" placeholder="Hasło">
                        <p class="help-block text-danger"></p>
                    </div>
                    <button type="submit" class="mt-3 btn btn-primary">Zarejestruj się</button>
                </form>
            </div>
        </div>
    </div>
@endsection
