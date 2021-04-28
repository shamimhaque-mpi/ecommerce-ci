<!-- include css -->
<link rel="stylesheet" href="<?=site_url('public/style/details.css')?>">

<!-- details section start -->
<section class="details_section">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 col-lg-8">
                <div class="product_div">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="product_images">
                                <img id="img_01" src="<?=site_url('public/images/product/item-1.jpg')?>" data-zoom-image="<?=site_url('public/images/product/item-1.jpg')?>" alt="">
                            </div>

                            <div class="owl-carousel tabs_product" id="gal1">
                                <a href="#" data-update="" data-image="<?=site_url('public/images/product/item-1.jpg')?>" data-zoom-image="<?=site_url('public/images/product/item-1.jpg')?>">
                                    <img src="<?=site_url('public/images/product/item-1.jpg')?>" alt="">
                                </a>
                                <a href="#" data-update="" data-image="<?=site_url('public/images/product/item-2.jpg')?>" data-zoom-image="<?=site_url('public/images/product/item-2.jpg')?>">
                                    <img src="<?=site_url('public/images/product/item-2.jpg')?>" alt="">
                                </a>
                                <a href="#" data-update="" data-image="<?=site_url('public/images/product/item-3.jpg')?>" data-zoom-image="<?=site_url('public/images/product/item-3.jpg')?>">
                                    <img src="<?=site_url('public/images/product/item-3.jpg')?>" alt="">
                                </a>
                                <a href="#" data-update="" data-image="<?=site_url('public/images/product/item-4.jpg')?>" data-zoom-image="<?=site_url('public/images/product/item-4.jpg')?>">
                                    <img src="<?=site_url('public/images/product/item-4.jpg')?>" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="product_details">
                                <h4>Product Title Name</h4>
                                <h5 class="price"><del>৳24,900</del>৳14,900</h5>
                                <p>Want it by Tomorrow ? Order within the next 23 hrs 9 mins to get it delivered on 16 May before 8:00PM, by
                                    choosing "FastPick" at checkout.</p>

                                <div class="size_box">
                                    <h6>Size:</h6>
                                    <span class="size active">S</span>
                                    <span class="size">M</span>
                                    <span class="size">L</span>
                                </div>
                                <div class="color_box">
                                    <h6>Color:</h6>
                                    <ul class="color_list">
                                        <li class="black">
                                            <span></span>
                                            <input type="radio" name="color">
                                        </li>
                                        <li class="red">
                                            <span></span>
                                            <input type="radio" name="color">
                                        </li>
                                        <li class="green">
                                            <span></span>
                                            <input type="radio" name="color">
                                        </li>
                                        <li class="blue">
                                            <span></span>
                                            <input type="radio" name="color">
                                        </li>
                                        <li class="maroon">
                                            <span></span>
                                            <input type="radio" name="color" checked>
                                        </li>
                                    </ul>
                                </div>

                                <div class="quantity">
                                    <h6>Quantity</h6>
                                    <div class="qty_form">
                                        <button onclick="qty.value=(qty.value>0?qty.value-=1:qty.value)"><i class="icon ion-md-remove"></i></button>
                                        <input type="text" id="qty" value="1" min="0">
                                        <button onclick="qty.value = +qty.value+1"><i class="icon ion-md-add"></i></button>
                                    </div>
                                </div>

                                <div class="submit-btn">
                                    <a href="">Add to cart</a>
                                    <a href="">Buy Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="product_feature">
                    <h3>Product Details Title</h3>
                    <p>Perferendis corrupti doloribus, qui asperiores ea veniam, earum ut possimus sequi! Sapiente, consectetur. Doloremque minus animi consequatur ea esse tempora et magnam voluptatem deserunt expedita vero modi iusto, odio qui nesciunt minima ad quidem incidunt, harum dolores voluptates accusantium ducimus voluptas reprehenderit? Ipsum debitis qui sint perferendis.</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque, quo itaque blanditiis aspernatur consequuntur quidem nihil!</p>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus distinctio quia delectus, reiciendis itaque ex repellat pariatur, nulla aspernatur animi aut inventore quis necessitatibus fugit fugiat excepturi vitae perferendis! Fugiat.</p>
                </div>

                <div class="similar_product">
                    <div class="section_title">
                        <h3>Similar Products</h3>
                    </div>
                    <div class="row smproduct_grid">
                        <div class="col-xl-3 col-lg-4 col-md-4 col-6">
                            <div class="product_box">
                                <figure class="product_gallery">
                                    <div class="product_img">
                                        <img class="product_one" src="<?=site_url('public/images/product/item-1.jpg')?>" alt="">
                                        <img class="product_two" src="<?=site_url('public/images/product/item-1.jpg')?>" alt="">
                                    </div>
                                    <a href="<?=site_url('details')?>" class="cover"></a>
                                    <figcaption>
                                        <a href="#"><i class="icon ion-ios-cart"></i></a>
                                        <a href="#"><i class="icon ion-md-heart-empty"></i></a>
                                    </figcaption>
                                </figure>
                                <div class="product_title">
                                    <h5><a href="<?=site_url('details')?>">Product Name Or Title</a></h5>
                                    <h4>720 Tk <del>920.00 Tk</del></h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-4 col-6">
                            <div class="product_box">
                                <figure class="product_gallery">
                                    <div class="product_img">
                                        <img class="product_one" src="<?=site_url('public/images/product/item-1.jpg')?>" alt="">
                                        <img class="product_two" src="<?=site_url('public/images/product/item-1.jpg')?>" alt="">
                                    </div>
                                    <a href="<?=site_url('details')?>" class="cover"></a>
                                    <figcaption>
                                        <a href="#"><i class="icon ion-ios-cart"></i></a>
                                        <a href="#"><i class="icon ion-md-heart-empty"></i></a>
                                    </figcaption>
                                </figure>
                                <div class="product_title">
                                    <h5><a href="<?=site_url('details')?>">Product Name Or Title</a></h5>
                                    <h4>720 Tk <del>920.00 Tk</del></h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-4 col-6">
                            <div class="product_box">
                                <figure class="product_gallery">
                                    <img src="<?=site_url('public/images/product/item-3.jpg')?>" alt="">
                                    <a href="<?=site_url('details')?>" class="cover"></a>
                                    <figcaption>
                                        <a href="#"><i class="icon ion-ios-cart"></i></a>
                                        <a href="#"><i class="icon ion-md-heart-empty"></i></a>
                                    </figcaption>
                                </figure>
                                <div class="product_title">
                                    <h5><a href="<?=site_url('details')?>">Product Name Or Title</a></h5>
                                    <h4>720 Tk <del>920.00 Tk</del></h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-4 col-6">
                            <div class="product_box">
                                <figure class="product_gallery">
                                    <img src="<?=site_url('public/images/product/item-3.jpg')?>" alt="">
                                    <a href="<?=site_url('details')?>" class="cover"></a>
                                    <figcaption>
                                        <a href="#"><i class="icon ion-ios-cart"></i></a>
                                        <a href="#"><i class="icon ion-md-heart-empty"></i></a>
                                    </figcaption>
                                </figure>
                                <div class="product_title">
                                    <h5><a href="<?=site_url('details')?>">Product Name Or Title</a></h5>
                                    <h4>720 Tk <del>920.00 Tk</del></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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

                <!-- similar product -->
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
                </div>


                <!-- related product -->
                <div class="suggest_product">
                   <div class="title">
                       <h5>Related product</h5>
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
                        <img src="<?=site_url('public/images/product/item-4.jpg')?>" alt="">
                        <div class="items-content">
                            <h5>Product title name</h5>
                            <small>720 Tk <del>930.00 Tk</del></small>
                        </div>
                        <a href="<?=site_url('details')?>" class="items-cover"></a>
                    </div>
                    <div class="items">
                        <img src="<?=site_url('public/images/product/item-5.jpg')?>" alt="">
                        <div class="items-content">
                            <h5>Product title name</h5>
                            <small>720 Tk <del>930.00 Tk</del></small>
                        </div>
                        <a href="<?=site_url('details')?>" class="items-cover"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- details section end -->
