<!-- include css -->
<link rel="stylesheet" href="<?=site_url('public/style/single.css')?>">

<!-- single page start -->
<section class="single_page">
    <div class="container">
        <?php if($page_content) { ?>
        	<h2><?=filter($page_content->title)?></h2>
        	<?=filter($page_content->description)?>
        <?php } else { ?>
        	<p>Nothing</p>
        <?php } ?>
    </div>
</section>
<!-- single page end -->
