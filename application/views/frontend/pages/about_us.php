<!-- include css -->
<link rel="stylesheet" href="<?=site_url('public/style/single.css')?>">

<!-- single page start -->
<section class="single_page">
    <div class="container">
        <h2>Our purpose</h2>
        <?php if($about && $about->path){ ?>
            <img src="<?=site_url($about->path)?>" alt="">
        <?php } ?>

		<?=($about ? $about->description : '')?>
    </div>
</section>
<!-- single page end -->
