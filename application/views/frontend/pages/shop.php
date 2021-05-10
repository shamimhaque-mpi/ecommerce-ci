<!-- include css -->
<link rel="stylesheet" href="<?=site_url('public/style/shop.css')?>">

<!-- shop section start -->
<section class="shop_section">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-4">
				<!-- price filter -->
				<div class="product_aside">
					<h4 class="aside_title">Filter By Price</h4>
					<div class="price_filter">
						<div id="slider-range"></div>
						<div class="price_value">
							<div class="price">
								<strong>Min:</strong> <span id="slider-range-value1"></span>
							</div>
							<div class="price">
								<strong>Max:</strong> <span id="slider-range-value2"></span>
							</div>
						</div>
					</div>
				</div>

				<!-- product aside -->
				<div class="product_aside">
					<h4 class="aside_title">Filter By Category</h4>
					<div class="product_menu">
						<ul class="menu_list">
							<?php
							$categories = readTable('categories', ['trash'=>0], ['orderBy'=>['id', 'DESC'], 'limit'=>100]);
							if(!empty($categories)) foreach ($categories as $key => $row) {
							?>
							<li><a href="<?=site_url("shop/".toBase64(['products.cat_id'=>$row->id]))."/".toSlug($row->category)?>"><?=($row->category)?> - <small>(10)</small></a></li>
							<?php } ?>
						</ul>
					</div>
				</div>

				<!-- rating filter -->
				<div class="product_aside">
					<h4 class="aside_title">Filter By Rating</h4>
					<ul class="rating_value">
						<li><a href="#">
							<i class="icon ion-md-star"></i>
							<i class="icon ion-md-star"></i>
							<i class="icon ion-md-star"></i>
							<i class="icon ion-md-star"></i>
							<i class="icon ion-md-star"></i>
						</a></li>
						<li><a href="#">
							<i class="icon ion-md-star"></i>
							<i class="icon ion-md-star"></i>
							<i class="icon ion-md-star"></i>
							<i class="icon ion-md-star"></i>
							<i class="icon ion-md-star-outline"></i>
							<span>And Up</span>
						</a></li>
						<li><a href="#">
							<i class="icon ion-md-star"></i>
							<i class="icon ion-md-star"></i>
							<i class="icon ion-md-star"></i>
							<i class="icon ion-md-star-outline"></i>
							<i class="icon ion-md-star-outline"></i>
							<span>And Up</span>
						</a></li>
						<li><a href="#">
							<i class="icon ion-md-star"></i>
							<i class="icon ion-md-star"></i>
							<i class="icon ion-md-star-outline"></i>
							<i class="icon ion-md-star-outline"></i>
							<i class="icon ion-md-star-outline"></i>
							<span>And Up</span>
						</a></li>
						<li><a href="#">
							<i class="icon ion-md-star"></i>
							<i class="icon ion-md-star-outline"></i>
							<i class="icon ion-md-star-outline"></i>
							<i class="icon ion-md-star-outline"></i>
							<i class="icon ion-md-star-outline"></i>
							<span>And Up</span>
						</a></li>
					</ul>
				</div>
			</div>
			<div class="col-lg-9 col-md-8">
				<div class="product_heading">
					<ul class="breadcrumb_list">
						<li><a href="#">Home</a></li>
						<li>Shop</li>
					</ul>
				</div>
				<?php if(!empty($products)){ ?>
				<div class="product_grid">
					<?php
					foreach($products as $key=>$row){
					if(($key+1)!=6){
					?>
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
							<a href="<?=site_url("products/".base64_encode($row->id)."/".(str_replace(' ', '-', $row->title)))?>" class="cover"></a>
							<figcaption>
								<?php if($row->quantity>0){ ?>
								<add-to-cart
		                            product_id="<?=($row->product_id)?>"
		                        ></add-to-cart>
								<?php }?>
		                        <add-to-wish-list
		                            product_id="<?=($row->product_id)?>"
		                        ></add-to-wish-list>
							</figcaption>
						</figure>
						<div class="product_title">
							<h5><a href="<?=site_url("products/".base64_encode($row->id)."/".(str_replace(' ', '-', $row->title)))?>"><?=($row->title)?></a></h5>
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
						</div>
					</div>
					<?php }} ?>
				</div>
				<?php } ?>
				<!-- pagination start -->
				<ul class="pagination">
					<li><span>Prev</span></li>
					<li class="active"><a href="">1</a></li>
					<li><a href="">2</a></li>
					<li><a href="">10</a></li>
					<li><a href="">11</a></li>
					<li><a href="">Next</a></li>
				</ul>
			</div>
		</div>
	</div>
</section>
<!-- shop section end -->
