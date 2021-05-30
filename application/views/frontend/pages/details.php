<!-- include css -->
<link rel="stylesheet" href="<?=site_url('public/style/details.css')?>">

<!-- details section start -->
<section class="details_section">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 col-lg-8">
                <?php
                    if($product){
                        $images = getImages($product->id);
                ?>
                <div class="product_div">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="product_images">
                                <img id="img_01" src="<?=site_url(str_replace('medium', 'large', $product->feature_photo))?>" data-zoom-image="<?=site_url(str_replace('medium', 'large', $product->feature_photo))?>" alt="">
                            </div>

                            <div class="owl-carousel tabs_product" id="gal1">
                                <?php if($images) foreach($images as $img){ ?>
                                <a href="#" data-update="" data-image="<?=site_url($img->large)?>" data-zoom-image="<?=site_url($img->large)?>">
                                    <img src="<?=site_url($img->small)?>" alt="">
                                </a>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="product_details">
                                <h4><?=($product->title)?></h4>
                                <h5 class="price">
                                    <?php
                                        if(!$product->sale_price){ $product->sale_price = $product->price;}
                                        if($product->discount > 0){
                                    ?>
                                    <?=($product->sale_price - (($product->sale_price/100)*$product->discount))?>Tk <del><?=($product->sale_price)?> Tk</del>
                                    <?php
                                        }
                                        else {
                                            echo "৳".$product->sale_price;
                                        }
                                    ?>
                                </h5>
                                <p><?=($product->short_description)?></p>
                                <product-details
                                    user_id="<?=(user() ? user()->id : '')?>"
                                    product_id="<?=($product->id)?>"
                                    available_quantity="<?=($product->quantity)?>"
                                ></product-details>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="product_feature">
                    <h3>Product Details Title</h3>
                    <?=($product->description)?>
                </div>

                <?php } if($similar_products){ ?>
                <div class="similar_product">
                    <div class="section_title">
                        <h3>Similar Products</h3>
                    </div>
                    <div class="row smproduct_grid">
                        <?php foreach($similar_products as $key=>$row){ ?>
                        <div class="col-xl-3 col-lg-4 col-md-4 col-6">
                            <div class="product_box">
                                <?php if($row->quantity <= 0){ ?>
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

                                    <a href="<?=site_url("products/".base64_encode($row->id)."/".slug($row->title))?>" class="cover"></a>

                                    <figcaption>
                                        <?php if($row->quantity>0){ ?>
                                        <add-to-cart
                                            product_id="<?=($row->id)?>"
                                        ></add-to-cart>
                                        <?php } ?>
                                        <add-to-wish-list
                                            product_id="<?=($row->id)?>"
                                        ></add-to-wish-list>
                                    </figcaption>
                                </figure>
                                <div class="product_title">
                                    <h5><a href="<?=site_url("products/".base64_encode($row->id)."/".slug($row->title))?>"><?=($row->title)?></a></h5>
                                    <?php $row->sale_price = ($row->sale_price ? $row->sale_price : $row->price) ?>
                                    <div class="footer_price">
                                        <h4>
                                            <?php if($row->sale_price){ if($row->discount > 0){ ?>
                                                <?=($row->sale_price - (($row->sale_price/100)*$row->discount))?> Tk <del><?=($row->sale_price)?> Tk</del>
                                            <?php } else{ echo $row->sale_price." Tk"; } } ?>
                                        </h4>
                                        <?=(showRating($row->rating))?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
            </div>


            <div class="col-xl-3 col-lg-4">
                <!-- payment box -->
                <div class="payment_box">
                    <h5>Payment method</h5>
                    <p>Cash/Card on delivery</p>
                    <p>bKash/Online payment</p>
                    <div class="payment-card">
                        <img src="<?=site_url('public/images/card/bkash.png')?>" alt="">
                        <img src="<?=site_url('public/images/card/nagot.png')?>" alt="">
                        <img src="<?=site_url('public/images/card/mastercard.png')?>" alt="">
                        <img src="<?=site_url('public/images/card/roket.png')?>" alt="">
                    </div>
                </div>

                <!-- Popular product -->
                <div class="suggest_product">
                   <div class="title">
                       <h5>Best Sale</h5>
                   </div>
                   <?php if(!empty($best_sale_product)) foreach ($best_sale_product as $row) { ?>
                    <div class="items">
                        <img src="<?=site_url($row->feature_photo)?>" alt="">
                        <div class="items-content">
                            <h5><?=($row->title)?></h5>
                            <?php if($row->discount>0 && $row->quantity){ ?>
                            <small><?=($row->sale_price - ($row->sale_price/100)*$row->discount)?>Tk <del><?=($row->sale_price)?>Tk</del></small>
                            <?php } else if($row->quantity){ ?>
                            <small><?=($row->sale_price)?>Tk</small>
                            <?php } else { ?>
                                <small>Out Of Stock</small>
                            <?php } ?>
                        </div>
                        <a href="<?=site_url("products/".base64_encode($row->id)."/".slug($row->title))?>" class="items-cover"></a>
                    </div>
                    <?php } ?>
                </div>


                <!-- Popular product -->
                <div class="suggest_product">
                   <div class="title">
                       <h5>Popular Products</h5>
                   </div>
                   <?php if(!empty($popular_products)) foreach ($popular_products as $row) { ?>
                    <div class="items">
                        <img src="<?=site_url($row->feature_photo)?>" alt="">
                        <div class="items-content">
                            <h5><?=($row->title)?></h5>
                            <?php if($row->discount>0 && $row->quantity){ ?>
                            <small><?=($row->sale_price - ($row->sale_price/100)*$row->discount)?>Tk <del><?=($row->sale_price)?>Tk</del></small>
                            <?php } else if($row->quantity){ ?>
                            <small><?=($row->sale_price)?>Tk</small>
                            <?php } else { ?>
                                <small>Out Of Stock</small>
                            <?php } ?>
                        </div>
                        <a href="<?=site_url("products/".base64_encode($row->id)."/".slug($row->title))?>" class="items-cover"></a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- details section end -->
