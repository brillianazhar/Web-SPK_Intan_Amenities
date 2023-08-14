<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="main-container">
    <div class="card-box">
        <div class="login-card">
            <h1>Sign in to Amenities</h1>
            <form class="form-card1" action="" method="post">
                <input class="form-input" type="text" id="email" name="email" placeholder="Email" autocomplete="off">
                <input class="form-input" type="password" id="password" name="password" placeholder="Password">
                <button class="btn-signin" type="submit">SIGN IN</button>
            </form>
        </div>
        <div class="signup-card">
            <div class="form-card2">
                <p>New Here?</p>
                <p>Sign up and discover a decision support system for selecting sandal sponge suppliers</p>
                <button class="btn-signup">SIGN UP</button>
            </div>
        </div>
    </div>
</div>

<!-- <div class="container">


    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">

                    <div class="row">
                        <div class="col-lg-7">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Login to AAA</h1>
                                </div>
                                <form class="user">
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                    </div>
                                    <a href="index.html" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </a>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-5 signup-box">
                            <div class="p-5 ">
                                <div class="text-center">
                                    <h1 class="h4">New Here?</h1>
                                    <p class="h5">Sign up and discover a decision support system for selecting sandal sponge suppliers</p>
                                </div>
                                <form class="user">
                                    <a href="index.html" class="btn btn-primary btn-user btn-block btn-signup">
                                        Sign Up
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div> -->

<?= $this->endSection(); ?>