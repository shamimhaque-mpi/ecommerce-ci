<!--include css -->
<link rel="stylesheet" href="<?=site_url('public/style/checkout.css')?>">

<!-- checkout section start -->
<section class="checkout_section">
    <checkout
    	user_id="<?=user()->id?>"
    	user_name="<?=user()->name?>"
    	user_mobile="<?=user()->mobile?>"
    	user_address="<?=user()->address?>"
    ></checkout>
</section>
<!-- checkout section end -->
