<!-- include css -->
<link rel="stylesheet" href="<?=site_url('public/style/user.css')?>">

<!-- profile section start -->
<section class="user_section">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="user_aside">
                    <h3><?=(user()->name)?></h3>
                    <ul class="user_menu">
                        <li><a href="<?=site_url('user-panel/dashboard')?>" class="nav-link">Dashboard</a></li>
                        <li><a href="<?=site_url('user-panel/settings')?>" class="nav-link">Settings</a></li>
                        <li><a href="" class="nav-link active">Profile</a></li>
                    </ul>
                    <a href="" class="btn logout_btn">Logout</a>
                </div>
            </div>
            <div class="col-md-8">
                <div class="user_content">

                </div>
            </div>
        </div>
    </div>
</section>
<!-- profile section end -->
