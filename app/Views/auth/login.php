<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container-auth">
    <div class="forms-container">
        <div class="signin-signup">

            <form action="/login" method="post" class="sign-in-form" id="sign-in-form">
                <h2 class="tittle">Sign In to Intan Amenities</h2>
                <?= session()->getFlashdata('message'); ?>
                <div class="container-input-field">
                    <div class="input-field form-control">
                        <i class="icons" data-feather="mail"></i>
                        <input type="text" id="email" name="email" placeholder="Email" autocomplete="off">
                    </div>
                    <label for="email" generated="true" class="error"></label>
                </div>
                <div class="container-input-field">
                    <div class="input-field form-control">
                        <i class="icons" data-feather="lock"></i>
                        <input type="password" id="password" name="password" placeholder="Password">
                    </div>
                    <label for="password" generated="true" class="error"></label>
                </div>
                <button class="btn-solid" type="submit">Sign In</button>
            </form>

            <form action="/signup" method="post" class="sign-up-form" id="sign-up-form">
                <h2 class="tittle">Sign Up to Intan Amenities</h2>
                <div class="container-input-field">
                    <div class="input-field form-control">
                        <i class="icons" data-feather="user"></i>
                        <input type="text" id="sgusername" name="sgusername" placeholder="Username" autocomplete="off">
                    </div>
                    <label for="sgusername" generated="true" class="error"></label>
                </div>
                <div class="container-input-field">
                    <div class="input-field form-control">
                        <i class="icons" data-feather="mail"></i>
                        <input type="text" id="sgemail" name="sgemail" placeholder="Email" autocomplete="off">
                    </div>
                    <label for="sgemail" generated="true" class="error"></label>
                </div>
                <div class="container-input-field">
                    <div class="input-field form-control">
                        <i class="icons" data-feather="lock"></i>
                        <input type="password" id="sgpassword1" name="sgpassword1" placeholder="Password">
                    </div>
                    <label for="sgpassword1" generated="true" class="error"></label>
                </div>
                <div class="container-input-field">
                    <div class="input-field form-control">
                        <i class="icons" data-feather="lock"></i>
                        <input type="password" id="sgpassword2" name="sgpassword2" placeholder="Confirm password">
                    </div>
                    <label for="sgpassword2" generated="true" class="error"></label>
                </div>
                <button id="btn-solid-signup" class="btn-solid" type="submit">Sign Up</button>
            </form>
        </div>
    </div>
    <div class="panels-container">
        <div class="panel left-panel">
            <div class="content" id="content1">
                <h3>New here ?</h3>
                <p>Sign up and discover a decision support system for selecting sandal sponge suppliers</p>
                <button class="btn-transparent" id="sign-up-btn">Sign Up</button>
            </div>
        </div>
        <div class="panel right-panel">
            <div class="content" id="content2">
                <h3>One of us ?</h3>
                <p>Sign in with your account and discover a decision support system for selecting sandal sponge suppliers</p>
                <button class="btn-transparent" id="sign-in-btn">Sign In</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>