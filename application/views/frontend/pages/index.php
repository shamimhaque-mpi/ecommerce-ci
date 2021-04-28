<!-- include css -->
<link rel="stylesheet" href="<?=site_url('public/style/home.css')?>">

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
            <a class="categories" href="<?=site_url('category')?>">
                <img src="<?=site_url($row->img)?>" alt="">
                <h5 class="title"><?=($row->category)?> <i class="icon ion-md-arrow-forward"></i></h5>
            </a>
            <?php } ?>
        </div>
    </div>
</section>
<!-- categories section end -->


<!-- product section start -->
<?php if(!empty($feature_products)){ ?>
<section class="product_section">
    <div class="container">
        <div class="section_title">
            <h3>Featured Products</h3>
            <?php if(count($feature_products)>5){ ?>
            <a href="<?=site_url('category')?>" class="view_all">View All</a>
            <?php } ?>
        </div>
        <div class="product_grid">
            <?php
                foreach($feature_products as $key=>$row){
                    if(($key+1)!=6){
            ?>
            <div class="product_box">
                <figure class="product_gallery">
                    <?php if($row->general_photo){ ?>
                        <div class="product_img">
                            <img class="product_one" src="<?=site_url($row->feature_photo)?>" alt="">
                            <img class="product_two" src="<?=site_url($row->general_photo)?>" alt="">
                        </div>
                    <?php } else { ?>
                        <img src="<?=site_url($row->feature_photo)?>" alt="">
                    <?php }?>
                    <a href="<?=site_url("products/".base64_encode($row->id)."/".(str_replace(' ', '-', $row->title)))?>" class="cover"></a>
                </figure>

                <div class="product_title">
                    <h5><a href="<?=site_url("products/".base64_encode($row->id)."/".(str_replace(' ', '-', $row->title)))?>"><?=($row->title)?></a></h5>
                </div>

            </div>
            <?php }} ?>
        </div>
    </div>
</section>
<?php } ?>
<!-- product section end -->



<!-- product section start -->
<?php
    if(!empty($category_wise)) foreach($category_wise as $row) {
        $products = getProducts(['products.cat_id'=>$row->id, 'products.feature_product'=>'no'], ['limit'=>6]);
        if(!empty($products)){
?>
<section class="product_section">
    <div class="container">
        <div class="section_title">
            <h3><?=($row->category)?></h3>
            <?php if(count($products)>5){ ?>
            <a href="<?=site_url('category')?>" class="view_all">View All</a>
            <?php } ?>
        </div>
        <div class="product_grid">
            <?php
                foreach($products as $key=>$row){
                    if(($key+1)!=6){
            ?>
            <div class="product_box">
                <?php if($row->quantity==0){ ?>
                <img class="stockout" src="<?=site_url('public/images/logo/stockout.png')?>" alt="">
                <?php }?>
                <figure class="product_gallery">
                    <?php if($row->general_photo){ ?>
                        <div class="product_img">
                            <img class="product_one" src="<?=site_url($row->feature_photo)?>" alt="">
                            <img class="product_two" src="<?=site_url($row->general_photo)?>" alt="">
                        </div>
                    <?php } else { ?>
                        <img src="<?=site_url($row->feature_photo)?>" alt="">
                    <?php }?>

                    <a href="<?=site_url("products/".base64_encode($row->id)."/".(str_replace(' ', '-', $row->title)))?>" class="cover"></a>
                    <?php if($row->quantity>0){ ?>
                    <figcaption>
                        <add-to-cart
                            product_id="<?=($row->id)?>"
                        ></add-to-cart>
                        <add-to-wish-list
                            product_id="<?=($row->id)?>"
                        ></add-to-wish-list>
                    </figcaption>
                    <?php } ?>
                </figure>
                <div class="product_title">
                    <h5><a href="<?=site_url("products/".base64_encode($row->id)."/".(str_replace(' ', '-', $row->title)))?>"><?=($row->title)?></a></h5>
                    <?php if($row->sale_price){ ?>
                    <div class="footer_price">
                        <h4><?=($row->sale_price)?> Tk <?=($row->discount > 0 ? "<del>{$row->discount} Tk</del>":'')?></h4>

                        <div class="raring">
                            <i class="icon ion-md-star"></i>
                            <i class="icon ion-md-star"></i>
                            <i class="icon ion-md-star"></i>
                            <i class="icon ion-md-star-half"></i>
                            <i class="icon ion-md-star-outline"></i>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <?php }} ?>
        </div>
    </div>
</section>
<?php }} ?>
<!-- product section end -->
