<div class="container">
    <div class="col-lg-4 offset-lg-4 mt-5 login-form">
        <div class="main-div">
            <div class="panel mb-5">
                <h2>Panel administracyjny</h2>
            </div>
            <form method="post" action="">
                <input type="text" name="action" title="action" value="login" hidden>
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
                    <span>Nie masz konta?</span> <a href="<?= HOME_URL; ?>admin/create-account">Utwórz konto!</a>
                </div>
                <button type="submit" class="btn btn-primary">Zaloguj się</button>
            </form>
        </div>
    </div>
</div>