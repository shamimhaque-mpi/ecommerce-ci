<!-- include css -->
<link rel="stylesheet" href="<?=site_url('public/style/category.css')?>">

<!-- product section start -->
<section class="product_section">
    <div class="container">
        <div class="section_title">
            <h3>Category Title</h3>
        </div>
        <div class="product_grid">
            <?php if(!empty($products)) foreach($products as $key=>$row){ ?>
            <div class="product_box">
                <figure class="product_gallery">
                    <img src="<?=site_url($row->medium)?>" alt="">
                    <a href="<?=site_url('details')?>" class="cover"></a>
                    <figcaption>
                        <a href="#"><i class="icon ion-ios-cart"></i></a>
                        <a href="#"><i class="icon ion-md-heart-empty"></i></a>
                    </figcaption>
                </figure>
                <div class="product_title">
                    <h5><a href="<?=site_url('details')?>">Product Name Or Title</a></h5>
                    <div class="footer_price">
                        <h4>720 Tk <del>920.00 Tk</del></h4>
                        <div class="raring">
                            <i class="icon ion-md-star"></i>
                            <i class="icon ion-md-star"></i>
                            <i class="icon ion-md-star"></i>
                            <i class="icon ion-md-star-half"></i>
                            <i class="icon ion-md-star-outline"></i>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<!-- product section end -->
