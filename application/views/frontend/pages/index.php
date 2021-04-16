<!-- header section start -->
<header class="header_section">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div id="header_slider" class="carousel slide carousel-fade" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php if(!empty($slider)) foreach($slider as $key=>$row){ ?>
                        <div class="carousel-item <?=($key==0?'active':'')?>">
                            <a href="#"><img src="<?=site_url($row->path)?>" alt=""></a>
                        </div>
                        <?php } ?>
                    </div>
                    <a class="carousel-control-prev" href="#header_slider" data-slide="prev">
                        <i class="icon ion-ios-arrow-back"></i>
                    </a>
                    <a class="carousel-control-next" href="#header_slider" data-slide="next">
                        <i class="icon ion-ios-arrow-forward"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div id="offer_slider" class="carousel slide carousel-fade" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php if(!empty($slider_offer)) foreach($slider_offer as $key=>$row){ ?>
                        <div class="carousel-item <?=($key==0?'active':'')?>">
                            <a href="#"><img src="<?=site_url($row->path)?>" alt=""></a>
                        </div>
                        <?php } ?>
                    </div>

                    <ol class="carousel-indicators">
                        <?php if(!empty($slider_offer)) foreach($slider_offer as $key=>$row){ ?>
                        <li data-target="#offer_slider" data-slide-to="<?=($key)?>" class="<?=($key==0?'active':'')?>"></li>
                        <?php } ?>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header section end -->



<!-- categories section start -->
<section class="categories_section">
    <div class="container">
        <div class="owl-carousel categories_carousel">
            <?php if(!empty($categories)) foreach($categories as $key=>$row){ ?>
            <a class="categories" href="#">
                <img src="<?=site_url($row->img)?>" alt="">
                <h5 class="title"><?=($row->category)?> <i class="icon ion-md-arrow-forward"></i></h5>
            </a>
            <?php } ?>
        </div>
    </div>
</section>
<!-- categories section end -->



<!-- product section start -->
<section class="product_section">
    <div class="container">
        <div class="section_title">
            <h3>Featured Products</h3>
            <a href="category.html" class="view_all">View All</a>
        </div>
        <div class="product_grid">
            <div class="product_box">
                <figure class="product_gallery">
                    <div class="product_img">
                        <img class="product_one" src="<?=site_url('/public')?>/images/product/item-1.jpg" alt="">
                        <img class="product_two" src="<?=site_url('/public')?>/images/product/item-1.jpg" alt="">
                    </div>
                    <a href="details.html" class="cover"></a>
                    <figcaption>
                        <a href="#"><i class="icon ion-ios-cart"></i></a>
                        <a href="#"><i class="icon ion-md-heart-empty"></i></a>
                    </figcaption>
                </figure>
                <div class="product_title">
                    <h5><a href="details.html">Product Name Or Title</a></h5>
                    <h4>720 Tk <del>920.00 Tk</del></h4>
                </div>
            </div>
            <div class="product_box">
                <figure class="product_gallery">
                    <div class="product_img">
                        <img class="product_one" src="<?=site_url('/public')?>/images/product/item-2.jpg" alt="">
                        <img class="product_two" src="<?=site_url('/public')?>/images/product/item-3.jpg" alt="">
                    </div>
                    <a href="details.html" class="cover"></a>
                    <figcaption>
                        <a href="#"><i class="icon ion-ios-cart"></i></a>
                        <a href="#"><i class="icon ion-md-heart-empty"></i></a>
                    </figcaption>
                </figure>
                <div class="product_title">
                    <h5><a href="details.html">Product Name Or Title</a></h5>
                    <h4>720 Tk <del>920.00 Tk</del></h4>
                </div>
            </div>
            <div class="product_box">
                <figure class="product_gallery">
                    <img src="<?=site_url('/public')?>/images/product/item-3.jpg" alt="">
                    <a href="details.html" class="cover"></a>
                    <figcaption>
                        <a href="#"><i class="icon ion-ios-cart"></i></a>
                        <a href="#"><i class="icon ion-md-heart-empty"></i></a>
                    </figcaption>
                </figure>
                <div class="product_title">
                    <h5><a href="details.html">Product Name Or Title</a></h5>
                    <h4>720 Tk <del>920.00 Tk</del></h4>
                </div>
            </div>
            <div class="product_box">
                <figure class="product_gallery">
                    <div class="product_img">
                        <img class="product_one" src="<?=site_url('/public')?>/images/product/item-2.jpg" alt="">
                        <img class="product_two" src="<?=site_url('/public')?>/images/product/item-3.jpg" alt="">
                    </div>
                    <a href="details.html" class="cover"></a>
                    <figcaption>
                        <a href="#"><i class="icon ion-ios-cart"></i></a>
                        <a href="#"><i class="icon ion-md-heart-empty"></i></a>
                    </figcaption>
                </figure>
                <div class="product_title">
                    <h5><a href="details.html">Product Name Or Title</a></h5>
                    <h4>720 Tk <del>920.00 Tk</del></h4>
                </div>
            </div>
            <div class="product_box">
                <figure class="product_gallery">
                    <img src="<?=site_url('/public')?>/images/product/item-3.jpg" alt="">
                    <a href="details.html" class="cover"></a>
                    <figcaption>
                        <a href="#"><i class="icon ion-ios-cart"></i></a>
                        <a href="#"><i class="icon ion-md-heart-empty"></i></a>
                    </figcaption>
                </figure>
                <div class="product_title">
                    <h5><a href="details.html">Product Name Or Title</a></h5>
                    <h4>720 Tk <del>920.00 Tk</del></h4>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- product section end -->



<!-- product section start -->
<section class="product_section">
    <div class="container">
        <div class="section_title">
            <h3>MerchExpo Products</h3>
            <a href="category.html" class="view_all">View All</a>
        </div>
        <div class="product_grid">
            <div class="product_box">
                <figure class="product_gallery">
                    <div class="product_img">
                        <img class="product_one" src="<?=site_url('public')?>/images/product/item-1.jpg" alt="">
                        <img class="product_two" src="<?=site_url('public')?>/images/product/item-1.jpg" alt="">
                    </div>
                    <a href="details.html" class="cover"></a>
                    <figcaption>
                        <a href="#"><i class="icon ion-ios-cart"></i></a>
                        <a href="#"><i class="icon ion-md-heart-empty"></i></a>
                    </figcaption>
                </figure>
                <div class="product_title">
                    <h5><a href="details.html">Product Name Or Title</a></h5>
                    <h4>720 Tk <del>920.00 Tk</del></h4>
                </div>
            </div>
            <div class="product_box">
                <figure class="product_gallery">
                    <div class="product_img">
                        <img class="product_one" src="<?=site_url('public')?>/images/product/item-2.jpg" alt="">
                        <img class="product_two" src="<?=site_url('public')?>/images/product/item-3.jpg" alt="">
                    </div>
                    <a href="details.html" class="cover"></a>
                    <figcaption>
                        <a href="#"><i class="icon ion-ios-cart"></i></a>
                        <a href="#"><i class="icon ion-md-heart-empty"></i></a>
                    </figcaption>
                </figure>
                <div class="product_title">
                    <h5><a href="details.html">Product Name Or Title</a></h5>
                    <h4>720 Tk <del>920.00 Tk</del></h4>
                </div>
            </div>
            <div class="product_box">
                <figure class="product_gallery">
                    <img src="<?=site_url('/public')?>/images/product/item-3.jpg" alt="">
                    <a href="details.html" class="cover"></a>
                    <figcaption>
                        <a href="#"><i class="icon ion-ios-cart"></i></a>
                        <a href="#"><i class="icon ion-md-heart-empty"></i></a>
                    </figcaption>
                </figure>
                <div class="product_title">
                    <h5><a href="details.html">Product Name Or Title</a></h5>
                    <h4>720 Tk <del>920.00 Tk</del></h4>
                </div>
            </div>
            <div class="product_box">
                <figure class="product_gallery">
                    <div class="product_img">
                        <img class="product_one" src="<?=site_url('public')?>/images/product/item-2.jpg" alt="">
                        <img class="product_two" src="<?=site_url('public')?>/images/product/item-3.jpg" alt="">
                    </div>
                    <a href="details.html" class="cover"></a>
                    <figcaption>
                        <a href="#"><i class="icon ion-ios-cart"></i></a>
                        <a href="#"><i class="icon ion-md-heart-empty"></i></a>
                    </figcaption>
                </figure>
                <div class="product_title">
                    <h5><a href="details.html">Product Name Or Title</a></h5>
                    <h4>720 Tk <del>920.00 Tk</del></h4>
                </div>
            </div>
            <div class="product_box">
                <figure class="product_gallery">
                    <img src="<?=site_url('/public')?>/images/product/item-3.jpg" alt="">
                    <a href="details.html" class="cover"></a>
                    <figcaption>
                        <a href="#"><i class="icon ion-ios-cart"></i></a>
                        <a href="#"><i class="icon ion-md-heart-empty"></i></a>
                    </figcaption>
                </figure>
                <div class="product_title">
                    <h5><a href="details.html">Product Name Or Title</a></h5>
                    <h4>720 Tk <del>920.00 Tk</del></h4>
                </div>
            </div>
            <div class="product_box">
                <figure class="product_gallery">
                    <img src="<?=site_url('/public')?>/images/product/item-4.jpg" alt="">
                    <a href="details.html" class="cover"></a>
                    <figcaption>
                        <a href="#"><i class="icon ion-ios-cart"></i></a>
                        <a href="#"><i class="icon ion-md-heart-empty"></i></a>
                    </figcaption>
                </figure>
                <div class="product_title">
                    <h5><a href="details.html">Product Name Or Title</a></h5>
                    <h4>720 Tk <del>920.00 Tk</del></h4>
                </div>
            </div>
            <div class="product_box">
                <figure class="product_gallery">
                    <img src="<?=site_url('/public')?>/images/product/item-5.jpg" alt="">
                    <a href="details.html" class="cover"></a>
                    <figcaption>
                        <a href="#"><i class="icon ion-ios-cart"></i></a>
                        <a href="#"><i class="icon ion-md-heart-empty"></i></a>
                    </figcaption>
                </figure>
                <div class="product_title">
                    <h5><a href="details.html">Product Name Or Title</a></h5>
                    <h4>720 Tk <del>920.00 Tk</del></h4>
                </div>
            </div>
            <div class="product_box">
                <figure class="product_gallery">
                    <img src="<?=site_url('/public')?>/images/product/item-6.jpg" alt="">
                    <a href="details.html" class="cover"></a>
                    <figcaption>
                        <a href="#"><i class="icon ion-ios-cart"></i></a>
                        <a href="#"><i class="icon ion-md-heart-empty"></i></a>
                    </figcaption>
                </figure>
                <div class="product_title">
                    <h5><a href="details.html">Product Name Or Title</a></h5>
                    <h4>720 Tk <del>920.00 Tk</del></h4>
                </div>
            </div>
            <div class="product_box">
                <figure class="product_gallery">
                    <img src="<?=site_url('/public')?>/images/product/item-7.jpg" alt="">
                    <a href="details.html" class="cover"></a>
                    <figcaption>
                        <a href="#"><i class="icon ion-ios-cart"></i></a>
                        <a href="#"><i class="icon ion-md-heart-empty"></i></a>
                    </figcaption>
                </figure>
                <div class="product_title">
                    <h5><a href="details.html">Product Name Or Title</a></h5>
                    <h4>720 Tk <del>920.00 Tk</del></h4>
                </div>
            </div>
            <div class="product_box">
                <figure class="product_gallery">
                    <img src="<?=site_url('/public')?>/images/product/item-8.jpg" alt="">
                    <a href="details.html" class="cover"></a>
                    <figcaption>
                        <a href="#"><i class="icon ion-ios-cart"></i></a>
                        <a href="#"><i class="icon ion-md-heart-empty"></i></a>
                    </figcaption>
                </figure>
                <div class="product_title">
                    <h5><a href="details.html">Product Name Or Title</a></h5>
                    <h4>720 Tk <del>920.00 Tk</del></h4>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- product section end -->


<!-- product section start -->
<section class="product_section">
    <div class="container">
        <div class="section_title">
            <h3>Popular right now</h3>
            <a href="category.html" class="view_all">View All</a>
        </div>
        <div class="product_grid">
            <div class="product_box">
                <figure class="product_gallery">
                    <div class="product_img">
                        <img class="product_one" src="<?=site_url('/public')?>/images/product/item-1.jpg" alt="">
                        <img class="product_two" src="<?=site_url('/public')?>/images/product/item-1.jpg" alt="">
                    </div>
                    <a href="details.html" class="cover"></a>
                    <figcaption>
                        <a href="#"><i class="icon ion-ios-cart"></i></a>
                        <a href="#"><i class="icon ion-md-heart-empty"></i></a>
                    </figcaption>
                </figure>
                <div class="product_title">
                    <h5><a href="details.html">Product Name Or Title</a></h5>
                    <h4>720 Tk <del>920.00 Tk</del></h4>
                </div>
            </div>
            <div class="product_box">
                <figure class="product_gallery">
                    <img src="<?=site_url('/public')?>/images/product/item-4.jpg" alt="">
                    <a href="details.html" class="cover"></a>
                    <figcaption>
                        <a href="#"><i class="icon ion-ios-cart"></i></a>
                        <a href="#"><i class="icon ion-md-heart-empty"></i></a>
                    </figcaption>
                </figure>
                <div class="product_title">
                    <h5><a href="details.html">Product Name Or Title</a></h5>
                    <h4>720 Tk <del>920.00 Tk</del></h4>
                </div>
            </div>
            <div class="product_box">
                <figure class="product_gallery">
                    <img src="<?=site_url('/public')?>/images/product/item-6.jpg" alt="">
                    <a href="details.html" class="cover"></a>
                    <figcaption>
                        <a href="#"><i class="icon ion-ios-cart"></i></a>
                        <a href="#"><i class="icon ion-md-heart-empty"></i></a>
                    </figcaption>
                </figure>
                <div class="product_title">
                    <h5><a href="details.html">Product Name Or Title</a></h5>
                    <h4>720 Tk <del>920.00 Tk</del></h4>
                </div>
            </div>
            <div class="product_box">
                <figure class="product_gallery">
                    <img src="<?=site_url('/public')?>/images/product/item-7.jpg" alt="">
                    <a href="details.html" class="cover"></a>
                    <figcaption>
                        <a href="#"><i class="icon ion-ios-cart"></i></a>
                        <a href="#"><i class="icon ion-md-heart-empty"></i></a>
                    </figcaption>
                </figure>
                <div class="product_title">
                    <h5><a href="details.html">Product Name Or Title</a></h5>
                    <h4>720 Tk <del>920.00 Tk</del></h4>
                </div>
            </div>
            <div class="product_box">
                <figure class="product_gallery">
                    <img src="<?=site_url('/public')?>/images/product/item-8.jpg" alt="">
                    <a href="details.html" class="cover"></a>
                    <figcaption>
                        <a href="#"><i class="icon ion-ios-cart"></i></a>
                        <a href="#"><i class="icon ion-md-heart-empty"></i></a>
                    </figcaption>
                </figure>
                <div class="product_title">
                    <h5><a href="details.html">Product Name Or Title</a></h5>
                    <h4>720 Tk <del>920.00 Tk</del></h4>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- product section end -->

<!-- subscribe section start -->
<section class="subscribe_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="title">
                    <img src="<?=site_url('/public')?>/images/bg_images/subscriber.png" alt="">
                    <h4>Sign Up for newsletter for Offer and Updates</h4>
                </div>
            </div>
            <div class="col-lg-6">
                <form action="#" method="POST">
                    <input type="text" class="form-control" placeholder="Enter Your Email">
                    <button type="submit" class="btn">Subscribe</button>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- subscribe section end -->