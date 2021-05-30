<!-- include css -->
<link rel="stylesheet" href="<?=site_url('public/style/view_cart.css')?>">

<!-- viewCart section start -->
<section class="viewCart_section">
    <div class="container">
        <div class="row">
            <!-- suggest product -->
            <div class="col-lg-3 d-lg-block d-none">
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
                        <a href="<?=site_url("products/".base64_encode($row->id)."/".(str_replace(' ', '-', $row->title)))?>" class="items-cover"></a>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <view-cart></view-cart>
        </div>
    </div>
</section>
<!-- viewCart section end -->
