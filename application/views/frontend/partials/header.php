<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- title -->
    <title><?=(isset($title) ? $title : '😢')?> | <?=($header?$header->web_title:'')?></title>
    <!-- favicon -->
    <link rel="shortcut icon" href="<?=site_url($header?$header->fev_icon:'')?>">
    <!-- ionicons -->
    <link rel="stylesheet" href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css">
    <!-- owl carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <!-- include css -->
    <link rel="stylesheet" href="<?=site_url('public/style/master.css')?>">
    <link rel="stylesheet" href="<?=site_url('public/style/home.css')?>">
</head>
<body>
    <section class="nav_section">
    <!-- top nav start -->
        <nav class="top_nav">
            <div class="container">
                <div class="top_content">
                    <div class="contact_access">
                        <a href="mailto:hello@info.com"><i class="icon ion-ios-mail"></i> <?=($footer?$footer->email:'')?></a>
                        <a href="tel:01937476716" class="call"><i class="icon ion-ios-call"></i> <?=($footer?$footer->phone:'')?></a>
                    </div>
                    <a href="#" class="top_brand">
                        <img src="<?=site_url($header?$header->web_logo:'')?>" alt="">
                    </a>

                    <div class="user_path">
                        <div class="acces_log">
                            <a href="login.html"><i class="icon ion-md-person"></i> <span>Sign In</span></a>
                            <a href="registration.html"><i class="icon ion-md-person-add"></i> <span>Register</span></a>
                        </div>
                        <div class="dropdown">
                            <div class="user_menu" data-toggle="dropdown">
                                <i class="icon ion-md-contact"></i>
                            </div>
                            <ul class="dropdown-menu">
                                <li><a href="dashboard.html"><i class="icon ion-ios-speedometer"></i> Dashboard</a></li>
                                <li><a href="profile.html"><i class="icon ion-md-person-add"></i> Profile</a></li>
                                <li><a href="settings.html"><i class="icon ion-md-cog"></i> Settings</a></li>
                                <li><a href=""><i class="icon ion-md-log-out"></i> Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <!-- top nav end -->

        <!-- brand nav start -->
        <nav class="brand_nav">
            <div class="container">
                <div class="brand_content">
                    <a href="#" class="brand">
                        <img src="<?=site_url($header?$header->web_logo:'')?>" alt="">
                    </a>
                    <div class="collect_side">
                        <form action="#" method="post" class="search_form">
                            <select class="form-control" name="select_category">
                                <option value="" disabled selected>All Product</option>
                                <option value="">Select Product</option>
                                <option value="">Select Product</option>
                            </select>
                            <input type="text" name="search" class="form-control" placeholder="Search Here...">
                            <button type="submit" name="button" class="btn">
                                <i class="icon ion-md-search"></i>
                            </button>
                        </form>

                        <ul class="collect_list">
                            <li class="android">
                                <a href="#"><i class="icon ion-logo-android"></i></a>
                            </li>
                            <li class="cartBtn">
                                <a href="#"><i class="icon ion-ios-cart"></i></a>
                                <span>0</span>
                            </li>
                            <li>
                                <a href="#"><i class="icon ion-md-heart"></i></a>
                                <span>12</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <!-- brand nav end -->
<!-- 01716543233 -->
        <!-- navbar start here -->
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <div class="col-lg-3 col-sm-5 col-7 px-lg-0">
                    <div class="category_nav">
                        <div class="category_head">
                            <a href="javascript:void(0)"><i class="icon ion-md-menu"></i>Categores</a>
                        </div>
                        <ul class="category_list">
                            <?php
                                $categories = readTable('categories', ['trash'=>0], ['orderBy'=>['id', 'DESC']]);
                                if(!empty($categories)) foreach ($categories as $key => $row) {
                            ?>
                            <li><a href="#"><?=($row->category)?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                    <i class="icon ion-md-menu"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="single.html">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.html">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    <!-- navbar start end -->
    </section>