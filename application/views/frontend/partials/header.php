<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- title -->
    <title><?=(isset($title) ? $title : '😢')?> | <?=($header?$header->web_title:'')?></title>
    <!-- favicon -->
    <link rel="shortcut icon" href="<?=site_url($header?$header->fev_icon:'')?>">
    <!-- font-awesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- ionicons -->
    <link rel="stylesheet" href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css">
    <!-- owl carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <!-- bootstrap-select -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <!-- zoom images -->
    <link rel="stylesheet" href="<?=site_url('public/vendors/elevatezoom/css/jquery.ez-plus.css')?>">
    <!-- include css-->
    <link rel="stylesheet" href="<?=site_url('public/style/master.css')?>">
    <!-- axios -->
    <script src="<?=site_url('node_modules/axios/dist/axios.js')?>"></script>
    <!-- vuex -->
    <script src="<?=site_url('node_modules/vuex/dist/vuex.js')?>"></script>
    <!-- Helper -->
    <script src="<?=site_url('public/js/helper.js')?>"></script>
</head>

<body>
    <div id="app">
    <section class="nav_section">
    <!-- top nav start -->
        <nav class="top_nav">
            <div class="container">
                <div class="top_content">
                    <div class="contact_access">
                        <a href="mailto:hello@info.com"><i class="icon ion-ios-mail"></i> <?=($footer?$footer->email:'')?></a>
                        <a href="tel:01937476716" class="call"><i class="icon ion-ios-call"></i> <?=($footer?$footer->phone:'')?></a>
                    </div>
                    <a href="<?=site_url('/')?>" class="top_brand">
                        <img src="<?=site_url($header?$header->web_logo:'')?>" alt="">
                    </a>
                    <div class="user_path">
                        <?php if(!user()){ ?>
                        <div class="acces_log">
                            <a href="<?=site_url('login')?>"><i class="icon ion-md-person"></i> <span>Log In</span></a>
                            <a href="<?=site_url('registration')?>"><i class="icon ion-md-person-add"></i> <span>Register</span></a>
                        </div>
                        <?php } else if(user()) {?>
                        <div class="dropdown">
                            <div class="user_menu" data-toggle="dropdown">
                                <i class="icon ion-md-contact"></i>
                                <span class="user_name"><?=(user()->name)?></span>
                            </div>
                            <ul class="dropdown-menu">
                                <li><a href="<?=site_url('user-panel/dashboard')?>"><i class="icon ion-ios-speedometer"></i> Dashboard</a></li>
                                <li><a href="<?=site_url('user-panel/profile')?>"><i class="icon ion-md-person-add"></i> Profile</a></li>
                                <li><a href="<?=site_url('user-panel/settings')?>"><i class="icon ion-md-cog"></i> Settings</a></li>
                                <li><a href="<?=site_url('logout')?>"><i class="icon ion-md-log-out"></i> Logout</a></li>
                            </ul>
                        </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </nav>
        <!-- top nav end -->


        <!-- brand nav start -->
        <nav class="brand_nav">
            <div class="container">
                <div class="brand_content">
                    <a href="<?=site_url('/')?>" class="brand">
                        <img src="<?=site_url($header?$header->web_logo:'')?>" alt="">
                    </a>
                    <div class="collect_side">
                        <form action="#" method="post" class="search_form">
                            <select class="form-control" id="search_field_brand" name="select_category">
                                <option value="" disabled selected>Brand</option>
                                <?php
                                    $brans = readTable('brands', ['trash'=>0]);
                                    if($brans) foreach ($brans as $key => $row) {
                                ?>
                                    <option value="<?=($row->id)?>"><?=($row->brand)?></option>

                                <?php }  ?>
                            </select>
                            <input type="text" name="search" class="form-control" autocomplete="off" placeholder="Search Here...">
                            <div class="search_suggest" id="search_suggest">

                            </div>
                            <button type="submit" name="button" class="btn">
                                <i class="icon ion-md-search"></i>
                            </button>
                        </form>

                        <collect-list is_login="<?php echo (user()?true:false)?>"
                            apk="<?=($header ? $header->apk : '')?>"
                            url="<?=base_url('/');?>">
                        </collect-list>
                    </div>
                </div>
            </div>
        </nav>
        <!-- brand nav end -->


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
                            <li><a href="<?=site_url("shop/".toBase64(['products.cat_id'=>$row->id]))."/".toSlug($row->category)?>"><?=($row->category)?></a></li>
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
                            <a class="nav-link active" href="<?=site_url('/')?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=site_url('shop')?>">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=site_url('about')?>">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=site_url('contact')?>">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    <!-- navbar start end -->
    </section>
