<link href="https://fonts.googleapis.com/css?family=Cookie|Josefin+Sans|Satisfy&display=swap" rel="stylesheet">

<!--panel header start here-->
<div class="container-fluid">
    <div class="row">
        <div class="dashboard_header_wrapper">
            <h1 class="title">Deshboard</h1>
        </div>
    </div>
</div>
<!--panel header end here-->

<div class="container-fluid">
    <div class="row">
   	    <?php msg();?>
   	    <div class="dashboard_box_wrapper">
           <div class="dash-box dash-box-1">
              <span>Today Order</span>
              <h1><?=number_format($today_total_order, 2)?></h1>
           </div>

           <div class="dash-box dash-box-2">
              <span>Total Order</span>
              <h1><?=number_format($total_order, 2)?></h1>
           </div>

           <div class="dash-box dash-box-3">
              <span>Pending Order</span>
              <h1><?=number_format($total_pending_order, 2)?></h1>
           </div>

           <div class="dash-box dash-box-6">
              <span>Total Delivered Order</span>
              <h1><?=number_format($total_delivered_order, 2)?></h1>
           </div>

           <div class="dash-box dash-box-7">
              <span>Sale Amount</span>
              <h1><?=number_format($total_sale, 2)?></h1>
           </div>

           <div class="dash-box dash-box-10">
              <span>Total Customer</span>
              <h1><?=number_format($total_user, 2)?></h1>
           </div>

           <div class="dash-box dash-box-11">
              <span>Feature Products</span>
              <h1><?=number_format($total_feature_product, 2)?></h1>
           </div>

           <div class="dash-box dash-box-12">
              <span>Total Products</span>
              <h1><?=number_format($total_product, 2)?></h1>
           </div>

           <div class="dash-box dash-box-1">
              <span>Sold Out Product</span>
              <h1><?=number_format($total_sold_out, 2)?></h1>
           </div>

        </div>
    </div>
</div>
