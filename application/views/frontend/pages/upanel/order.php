<!-- include css -->
<link rel="stylesheet" href="<?=site_url('public/style/user.css')?>">

<!-- dashboard section start -->
<section class="user_section pt-4">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="user_aside">
                    <h3><?=(user()->name)?></h3>
                    <ul class="user_menu">
                        <li><a href="<?=site_url('user-panel/dashboard')?>" class="nav-link">Dashboard</a></li>
                        <li><a href="" class="nav-link active">Order</a></li>
                        <li><a href="<?=site_url('user-panel/wishlist')?>" class="nav-link">Wishlist</a></li>
                        <li><a href="<?=site_url('user-panel/profile')?>" class="nav-link">Profile</a></li>
                    </ul>
                    <a href="<?=site_url('logout')?>" class="btn logout_btn">Logout</a>
                </div>
            </div>
            <div class="col-md-8">
                <div class="user_content">
                    <h5 class="user_title">Order List</h5>
                    <div class="table-responsive">
                        <?php if(!empty($order_list)){ ?>
                        <table class="table">
                            <tr>
                                <th>Order No</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th class="text-right">Action</th>
                            </tr>
                            <?php foreach($order_list as $key=>$item){ ?>
                            <tr>
                                <td>#<?=($item->code)?></td>
                                <td><?=date('M d, Y', strtotime($item->date))?></td>
                                <td>৳<?=number_format(($item->amount + $item->shipping_cost), 2)?> <span>for <?=($item->items)?> item</span></td>
                                <td><?=ucfirst(str_replace('_', ' ', $item->status))?></td>
                                <td class="text-right">
                                    <?php if($item->status=='pending'){ ?>
                                    <a href="<?=site_url('user-panel/order_cancelation/'.$item->id)?>" onclick="return confirm('Are You sure??')" class="order-btn product_cancle">Cancle</a>
                                    <?php } ?>
                                    <a href="<?=site_url('user-panel/order_view/'.$item->id)?>" class="order-btn product_view">View</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </table>
                        <?php } else{ ?>
                            <h3>Orders Not Found, <a href="<?=site_url('')?>">Back To Shop</a></h3>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- dashboard section end -->
