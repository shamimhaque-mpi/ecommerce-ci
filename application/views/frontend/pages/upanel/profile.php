<!-- include css -->
<link rel="stylesheet" href="<?=site_url('public/style/user.css')?>">

<!-- profile section start -->
<section class="user_section pt-4">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="user_aside">
                    <h3><?=(user()->name)?></h3>
                    <ul class="user_menu">
                        <li><a href="<?=site_url('user-panel/dashboard')?>" class="nav-link">Dashboard</a></li>
                        <li><a href="<?=site_url('user-panel/order')?>" class="nav-link">Order</a></li>
                        <li><a href="<?=site_url('user-panel/wishlist')?>" class="nav-link">Wishlist</a></li>
                        <li><a href="<?=site_url('user-panel/profile')?>" class="nav-link active">Profile</a></li>
                    </ul>
                    <a href="" class="btn logout_btn">Logout</a>
                </div>
            </div>
            <div class="col-md-8">
                <div class="user_content">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="form-label">Full Name</label>
                                <div class="form-group">
                                    <input type="text" value="<?=(user()->name)?>" name="name" class="form-control">
                                    <input type="hidden" name="id" value="<?=(user()->id)?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Email</label>
                                <div class="form-group">
                                    <input type="email" value="<?=(user()->email)?>" name="email" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Phone Number</label>
                                <div class="form-group">
                                    <input type="text" value="<?=(user()->mobile)?>" name="mobile" class="form-control">
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <label class="form-label">Address</label>
                                <div class="form-group">
                                    <textarea name="address" class="form-control"><?=(user()->address)?></textarea>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <button type="submit" class="btn submit_btn">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- profile section end -->
