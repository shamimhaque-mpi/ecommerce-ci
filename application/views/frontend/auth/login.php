<!-- include css -->
<link rel="stylesheet" href="<?=site_url('public/style/credential.css')?>">

<!-- credential section start -->
<section class="credential_section">
    <div class="container">
        <div class="col-lg-10 offset-lg-1">
            <div class="row">
                <div class="col-md-5 pr-0">
                    <div class="welcome_div">

                    </div>
                </div>
                <div class="col-md-7 pl-0">
                    <div class="form_div">
                        <h2>Please login</h2>
                        <form action="#" method="post">
                            <div class="form-group">
                                <input type="email" placeholder="Email" id="email" class="form-control" required autocomplete="off">
                                <label for="email">Email</label>
                            </div>
                            <div class="form-group">
                                <input type="password" id="password" placeholder="Password" class="form-control" required autocomplete="off">
                                <label for="password">Password</label>
                            </div>
                            <div class="form-group forgot-div">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="check">
                                    <label class="form-check-label" for="check">Check me out</label>
                                </div>
                                <a href="<?=site_url('forgot')?>">Forgot password</a>
                            </div>
                            <button type="submit" class="btn">Login</button>
                        </form>

                        <h6 class="credential-condition">Don’t have an account? <a href="<?=site_url('registration')?>">Register Now!</a></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- credential section end -->
