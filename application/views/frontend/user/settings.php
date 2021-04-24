<!-- include css -->
<link rel="stylesheet" href="<?=site_url('public/style/user.css')?>">

<!-- settings section start -->
<section class="user_section">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="user_aside">
                    <h3>Shamim Houqe</h3>
                    <ul class="user_menu">
                        <li><a href="dashboard.html" class="nav-link">Dashboard</a></li>
                        <li><a href="" class="nav-link active">Settings</a></li>
                        <li><a href="profile.html" class="nav-link">Profile</a></li>
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
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Email</label>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Phone Number</label>
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control">
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
<!-- settings section end -->
