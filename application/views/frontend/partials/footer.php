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


	<!-- footer section strar -->
	<footer class="footer_section">
	    <div class="container">
	        <div class="row">
	            <div class="col-lg-3 col-md-6">
	                <div class="contact_area">
	                    <h2>Contact Info</h2>
	                    <p><i class="icon ion-md-pin"></i> <?=($footer?$footer->location:'')?></p>
	                    <p><i class="icon ion-ios-mail"></i> Phone : <a href="tel:<?=($footer?$footer->phone:'')?>"><?=($footer?$footer->phone:'')?></a></p>
	                    <p><i class="icon ion-ios-phone-portrait"></i> <a href=""><?=($footer?$footer->email:'')?></a></p>
	                    <p><i class="icon ion-md-time"></i> <a href="">Open Time: Everyday 10AM - 9PM</a></p>
	                </div>
	            </div>
	            <div class="col-lg-3 col-md-6">
	                <div class="contact_area">
	                    <h2>My Account</h2>
	                    <ul class="important_link">
	                        <li><a href="">Customer info</a></li>
	                        <li><a href="">Shipping cart</a></li>
	                        <li><a href="">Addresses</a></li>
	                        <li><a href="">Wishlist</a></li>
	                        <li><a href="">Orders</a></li>
	                    </ul>
	                </div>
	            </div>
	            <div class="col-lg-3 col-md-6">
	                <div class="contact_area">
	                    <h2>Popular Category</h2>
	                    <ul class="important_link">
	                        <li><a href="category.html">Baby Care items</a></li>
	                        <li><a href="category.html">Baby Gears</a></li>
	                        <li><a href="category.html">Babies Mom</a></li>
	                        <li><a href="category.html">Baby Care items</a></li>
	                        <li><a href="category.html">Baby Gears</a></li>
	                    </ul>
	                </div>
	            </div>
	            <div class="col-lg-3 col-md-6">
	                <div class="contact_area">
	                    <h2>Important Link</h2>
	                    <ul class="important_link">
	                        <li><a href="policy.html">Order, Stock Availability & Pricing</a></li>
	                        <li><a href="policy.html">Security Policy</a></li>
	                        <li><a href="policy.html">Refund Policy</a></li>
	                        <li><a href="policy.html">Privacy Policy</a></li>
	                        <li><a href="policy.html">Terms of Use</a></li>
	                    </ul>
	                </div>
	            </div>
	        </div>
	    </div>
	</footer>
	<div class="footer_banner">
	    <div class="container">
	        <div class="social">
	            <a href="<?=($footer?$footer->fb_link:'')?>" target="_blank" class="facebook"><i class="icon ion-logo-facebook"></i></a>
	            <a href="<?=($footer?$footer->tw_link:'')?>" target="_blank" class="twitter"><i class="icon ion-logo-twitter"></i></a>
	            <a href="<?=($footer?$footer->in_link:'')?>" target="_blank" class="linkedin"><i class="icon ion-logo-linkedin"></i></a>
	            <a href="<?=($footer?$footer->youtube:'')?>" target="_blank" class="youtube"><i class="icon ion-logo-youtube"></i></a>
	        </div>
	        <div class="payment_card">
	            <img src="<?=site_url('/public/images/card/bkash.png')?>" alt="">
	            <img src="<?=site_url('/public/images/card/roket.png')?>" alt="">
	            <img src="<?=site_url('/public/images/card/nagot.png')?>" alt="">
	            <img src="<?=site_url('/public/images/card/mastercard.png')?>" alt="">
	        </div>
	    </div>
	</div>
	<footer class="secound_footer">
	    <div class="container content">
	        <p><span style="font-size: 18px;">©</span> 2021 - Ecommerce - All Right Reserved.</p>
	        <p>Developed by : <a href="http://www.freelanceitlab.com/" target="_blank">Freelanceitlab</a></p>
	    </div>
	</footer>
	</div>
	<!-- footer section end -->


	<!-- jQuery js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- bootstrap js -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
	<!-- owl carousel -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
	<!-- niceScroll js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
	<!-- bootstrap-select -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
	<!-- zoom images -->
	<script src="<?=site_url('public/vendors/elevatezoom/js/jquery.ez-plus.js')?>"></script>
	<script src="<?=site_url('public/vendors/elevatezoom/js/web.js')?>"></script>
	<!-- include js -->
	<script src="<?=site_url('public/js/searching.js')?>"></script>
	<script type="module" src="<?=site_url('application/views/frontend/vue/app.js')?>"></script>

	<!-- price fange js -->
	<script src="<?=site_url('public/vendors/pricerange/pricerange-script.js')?>"></script>


	<script>
		$(document).ready(()=>{
			/* categories carousel js */
		    $('.categories_carousel').owlCarousel({
		        autoplayTimeout:5000,
		        autoplay:false,
		        loop:true,
		        nav:true,
		        dots: false,
		        margin: 15,
		        // animateOut: 'slideOutUp',
		        // animateIn: 'slideInUp',
		        responsive:{
		            1200:{items:6},
		            991:{items:4},
		            767:{items:3},
		            576:{items:2},
		            0:{items:2}
		         }
		    });
		    /* nicescroll plugin */
		    $(".shop_section .product_menu, .search_suggest").niceScroll({
		        cursorcolor: 'rgba(20,20,20,0.3)',
		        cursorwidth: '10px',
		        cursorborderradius: '0px'
		    });

			/* tabs product */
		    $('.tabs_product').owlCarousel({
		        autoplay:true,
		        loop:false,
		        nav:false,
		        dots:false,
		        autoplayTimeout:5000,
		        margin: 5,
		        responsive:{
		            1200:{items:4},
		            991:{items:3},
		            768:{items:3},
		            576:{items:3},
		            0:{items:3}
		        }
		    });
		});
	</script>

</body>
