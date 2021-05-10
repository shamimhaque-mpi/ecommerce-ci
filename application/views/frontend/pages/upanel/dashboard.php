<!-- include css -->
<link rel="stylesheet" href="<?=site_url('public/style/user.css')?>">

<!-- dashboard section start -->
<section class="user_section pt-4">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="user_aside">
                    <h3><?=(user()->name)?></h3>
                    <ul class="user_menu">
                        <li><a href="" class="nav-link active">Dashboard</a></li>
                        <li><a href="<?=site_url('user-panel/order')?>" class="nav-link">Order</a></li>
                        <li><a href="<?=site_url('user-panel/wishlist')?>" class="nav-link">Wishlist</a></li>
                        <li><a href="<?=site_url('user-panel/profile')?>" class="nav-link">Profile</a></li>
                    </ul>
                    <a href="<?=site_url('logout')?>" class="btn logout_btn">Logout</a>
                </div>
            </div>
            <div class="col-md-8">
                <div class="user_content">
                    <p class="deshboard_title">From your account dashboard you can view your <a href="#">recent orders</a>, manage your <a href="#">shipping and billing addresses</a>.</p>
                    <div class="profile_dashbosrd">
                        <a href="<?=site_url('user-panel/order')?>">
                            <div class="dash_box">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                <h3>Orders</h3>
                            </div>
                        </a>
                        <a href="<?=site_url('user-panel/wishlist')?>">
                            <div class="dash_box">
                                <i class="fa fa-heart-o" aria-hidden="true"></i>
                                <h3>Wishlists</h3>
                            </div>
                        </a>
                        <a href="#">
                            <div class="dash_box">
                                <i class="fa fa-bell-o" aria-hidden="true"></i>
                                <h3>Notifications</h3>
                            </div>
                        </a>
                        <a href="<?=site_url('user-panel/profile')?>">
                            <div class="dash_box">
                                <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                <h3>Profile</h3>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- dashboard section end -->
