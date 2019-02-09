<!-- Page Header -->
<style>
    #success{
        text-align: center;
        padding: 10px;
        color: green;
    }
</style>
<header class="masthead" style="background-image: url('<?= HOME_URL; ?>assets/images/contact-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="page-heading">
                    <h1>Kontakt</h1>
                    <span class="subheading">Masz pytanie? Postaramy się odpowiedzieć.</span>
                </div>
            </div>
        </div>
    </div>
</header>

<?php
    $send_status=null;
        if(isset($_POST['name']) && !empty($_POST['name'])){
            $send_status = writeComment($_POST['name'], $_POST['email'], $_POST['phone'],$_POST['message']);
        }
?>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <p>Chcesz się skontaktować? Wypełnij poniższy formularz, aby wysłać do nas wiadomość, a skontaktujemy się z
                Tobą najszybciej, jak to możliwe!</p>
            <form name="sentMessage" id="contactForm" novalidate method="post">
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                        <label>Imie</label>
                        <input type="text" class="form-control" placeholder="Imie" id="name" name="name" required
                               data-validation-required-message="Please enter your name.">
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                        <label>Adres email</label>
                        <input type="email" class="form-control" placeholder="Adres email" id="email" name="email" required
                               data-validation-required-message="Please enter your email address.">
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label>Numer telefonu</label>
                        <input type="tel" class="form-control" placeholder="Numer telefonu" id="phone" name="phone" required
                               data-validation-required-message="Please enter your phone number.">
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                        <label>Wiadomość</label>
                        <textarea rows="5" class="form-control" placeholder="Wiadomość" id="message" name="message" required
                                  data-validation-required-message="Please enter a message."></textarea>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="sendMessageButton">Wyślij</button>
                </div>
                <div id="success">
                    <?php
                        if($send_status){
                            echo "Wiadomość została poprawnie wysłana";
                        }
                    ?>
                </div>
            </form>
        </div>
    </div>
</div>
