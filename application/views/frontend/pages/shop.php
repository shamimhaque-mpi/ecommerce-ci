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
						<div class="price_btn">
							<button type="button" onclick="shop()" name="button" class="btn srh_btn">Search</button>
						</div>
						<div class="price_value">
							<div class="price">
								<strong>Min:</strong> <span id="slider-range-value1" ></span>
								<?php
									$rang_info = readTable('products', ['trash'=>0], ['select'=>['MIN(price) AS min', 'MAX(price) AS max'], 'limit'=>1]);

									if(json_decode(base64_decode($slug), true)){
							            $slug  = json_decode(base64_decode($slug), true);
							        }

									$start = (!empty($slug['products.price >']) ? $slug['products.price >']:0);
									$end   = (!empty($slug['products.price <']) ? $slug['products.price <']:0);
								?>
								<!-- // -->
								<input type="hidden" id="cat_id" value="<?=(!empty($slug['products.cat_id']) ? $slug['products.cat_id'] : '')?>">
								<input type="hidden" id="from_rang" data-min="<?=($rang_info ? $rang_info[0]->min:0)?>" data-start="<?=($start)?>" name="from_rang">
								<input type="hidden" id="to_rang"   data-max="<?=($rang_info ? $rang_info[0]->max:0)?>" data-end="<?=($end)?>"     name="to_rang">
								<!-- // -->
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
								$categories = $this->db->query("
									SELECT
										*,
										(SELECT COUNT(products.id) FROM products WHERE products.cat_id = categories.id AND products.trash=0 AND products.feature_product='no' LIMIT 1) AS total_product
									FROM  categories
									WHERE trash=0
									ORDER BY id DESC
									LIMIT 100
								")->result();
								if(!empty($categories)) foreach ($categories as $key => $row) {
							?>
							<li><a href="javascript:void(0)" class="<?=((!empty($slug['products.cat_id']) && $slug['products.cat_id']==$row->id) ?'active':'')?>" onclick="shop({cat_id:<?=($row->id)?>})"><?=($row->category)?> - <small>(<?=($row->total_product)?>)</small></a></li>
							<?php } ?>
						</ul>
					</div>
				</div>

				<!-- rating filter -->
				<div class="product_aside">
					<h4 class="aside_title">Filter By Rating</h4>
					<ul class="rating_value">
						<li><a href="javascript:void(0)" onclick="shop({rate:5})"><?=showRating(5)?></a></li>
						<li><a href="javascript:void(0)" onclick="shop({rate:4})"><?=showRating(4)?></a></li>
						<li><a href="javascript:void(0)" onclick="shop({rate:3})"><?=showRating(3)?></a></li>
						<li><a href="javascript:void(0)" onclick="shop({rate:2})"><?=showRating(2)?></a></li>
						<li><a href="javascript:void(0)" onclick="shop({rate:1})"><?=showRating(1)?></a></li>
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
							<h5><a href="<?=site_url("products/".base64_encode($row->id)."/".slug($row->title))?>"><?=($row->title)?></a></h5>
							<div class="footer_price">
								<?php if($row->sale_price){ ?>
									<h4><?=($row->sale_price)?> Tk <?=($row->discount > 0 ? "<del>{$row->discount} Tk</del>":'')?></h4>
								<?php }else { ?>
									<h4><?=($row->price)?> Tk</h4>
								<?php } ?>
								<?=(showRating($row->rating))?>
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
				<?php } ?>

				<!-- // -->
				<?php
					$per_page_ = 24;
					if($total_product > $per_page_){
					$page = round($total_product/$per_page_);
				?>
				<!-- pagination start -->
				<ul class="pagination">
					<?php if(!empty($slug['offset']) && $slug['offset'] > 0){ ?>
						<li><a href="javascript:void(0)" onclick="shop({limit:<?=($per_page_)?>, offset:<?=($slug['offset']-$per_page_)?>})">Prev</a></li>
					<?php } else{ ?>
						<!-- // -->
						<li><span>Prev</span></li>
					<?php
						}
						for($i=0; $i< $page; $i++){
							$offset = ($per_page_*($i+1)-$per_page_);
					?>
					<li class="<?=(($slug['offset']==$offset) ? 'active' : '')?>"><a href="javascript:void(0)" onclick="shop({limit:<?=($per_page_)?>, offset:<?=($offset)?>})"><?=($i+1)?></a></li>
					<?php } ?>
					<?php if(!empty($slug['offset']) && ($slug['offset'] < (($page*$per_page_)-$per_page_)) || $slug['offset']==0){ ?>
						<li><a href="javascript:void(0)" onclick="shop({limit:<?=($per_page_)?>, offset:<?=($slug['offset']+$per_page_)?>})">Next</a></li>
					<?php } else{ ?>
						<!-- // -->
						<li><span>Next</span></li>
					<?php } ?>
				</ul>
				<?php } ?>
			</div>
		</div>
	</div>
</section>
<!-- shop section end -->
