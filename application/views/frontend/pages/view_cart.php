<!-- include css -->
<link rel="stylesheet" href="<?=site_url('public/style/view_cart.css')?>">

<!-- viewCart section start -->
<section class="viewCart_section">
    <div class="container">
        <div class="row">
            <!-- suggest product -->
            <div class="col-lg-3 d-lg-block d-none">
                <div class="suggest_product">
                   <div class="title">
                       <h5>Best Sale product</h5>
                   </div>
                    <div class="items">
                        <img src="<?=site_url('public/images/product/item-1.jpg')?>" alt="">
                        <div class="items-content">
                            <h5>Product title name</h5>
                            <small>720 Tk <del>930.00 Tk</del></small>
                        </div>
                        <a href="<?=site_url('details')?>" class="items-cover"></a>
                    </div>
                    <div class="items">
                        <img src="<?=site_url('public/images/product/item-2.jpg')?>" alt="">
                        <div class="items-content">
                            <h5>Product title name</h5>
                            <small>720 Tk <del>930.00 Tk</del></small>
                        </div>
                        <a href="<?=site_url('details')?>" class="items-cover"></a>
                    </div>
                    <div class="items">
                        <img src="<?=site_url('public/images/product/item-3.jpg')?>" alt="">
                        <div class="items-content">
                            <h5>Product title name</h5>
                            <small>720 Tk <del>930.00 Tk</del></small>
                        </div>
                        <a href="<?=site_url('details')?>" class="items-cover"></a>
                    </div>
                    <div class="items">
                        <img src="<?=site_url('public/images/product/item-2.jpg')?>" alt="">
                        <div class="items-content">
                            <h5>Product title name</h5>
                            <small>720 Tk <del>930.00 Tk</del></small>
                        </div>
                        <a href="<?=site_url('details')?>" class="items-cover"></a>
                    </div>
                    <div class="items">
                        <img src="<?=site_url('public/images/product/item-3.jpg')?>" alt="">
                        <div class="items-content">
                            <h5>Product title name</h5>
                            <small>720 Tk <del>930.00 Tk</del></small>
                        </div>
                        <a href="<?=site_url('details')?>" class="items-cover"></a>
                    </div>
                </div>
            </div>

            <!-- product menu -->
            <div class="col-lg-6">
                <div class="product_menu">
                    <img src="<?=site_url('public/images/product/item-1.jpg')?>" alt="">
                    <div class="product_title">
                        <h6><a href="">Product Name Or Title</a></h6>
                        <p>1 X Omnis dicam mentitum</p>
                        <p>720 Tk</p>
                        <p>Size: S</p>
                        <p>Color: Orange</p>
                    </div>
                    <div class="product_sum">
                        <div class="action">
                            <div class="qty_form">
                                <button onclick="qty.value=(qty.value>0?qty.value-=1:qty.value)"><i class="icon ion-md-remove"></i></button>
                                <input type="text" id="qty" value="1" min="0">
                                <button onclick="qty.value = +qty.value+1"><i class="icon ion-md-add"></i></button>
                            </div>
                            <a href="" class="delete">
                                <i class="icon ion-md-trash"></i>
                            </a>
                        </div>
                        <h6 class="total">Total = 22.71 Tk</h6>
                    </div>
                </div>
                <div class="product_menu">
                    <img src="<?=site_url('public/images/product/item-1.jpg')?>" alt="">
                    <div class="product_title">
                        <h6>Product Name Or Title</h6>
                        <p>1 X Omnis dicam mentitum</p>
                        <p>720 Tk</p>
                        <p>Size: S</p>
                        <p>Color: Orange</p>
                    </div>
                    <div class="product_sum">
                        <div class="action">
                            <input type="number" class="form-control" value="1" min="0">
                            <a href="" class="delete">
                                <i class="icon ion-md-trash"></i>
                            </a>
                        </div>
                        <h6 class="total">Total = 22.71 Tk</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="payment_box">
                    <table class="table payment_table">
                        <tbody>
                            <tr>
                                <th>Subtotal</th>
                                <td>$89.57</td>
                            </tr>
                            <tr>
                                <th>Shipping</th>
                                <td>$7.00</td>
                            </tr>
                            <tr>
                                <th>Taxes</th>
                                <td>$0.00</td>
                            </tr>
                            <tr style="border-top: 1px solid #eee;">
                                <th>Total</th>
                                <td>$90.00</td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="<?=site_url('checkout')?>" class="checkout_btn">Proceed to Checkout</a>
                </div>
                <div class="services_div">
                    <p><i class="icon ion-md-done-all"></i> Security Policy (Edit With Customer Reassurance Module)</p>
                </div>
                <div class="services_div">
                    <p><i class="icon ion-md-car"></i> Security Policy (Edit With Customer Reassurance Module)</p>
                </div>
                <div class="services_div">
                    <p><i class="icon ion-md-return-right"></i> Security Policy (Edit With Customer Reassurance Module)</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- viewCart section end -->
