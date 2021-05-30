<!-- include css -->
<link rel="stylesheet" href="<?=site_url('public/style/user.css')?>">

<!-- dashboard section start -->
<section class="user_section">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="user_aside">
                    <h3><?=(user()->name)?></h3>
                    <ul class="user_menu">
                        <li><a href="<?=site_url('user-panel/dashboard')?>" class="nav-link">Dashboard</a></li>
                        <li><a href="<?=site_url('user-panel/order')?>" class="nav-link active">Order</a></li>
                        <li><a href="<?=site_url('user-panel/wishlist')?>" class="nav-link">Wishlist</a></li>
                        <li><a href="<?=site_url('user-panel/profile')?>" class="nav-link">Profile</a></li>
                    </ul>
                    <a href="<?=site_url('logout')?>" class="btn logout_btn">Logout</a>
                </div>
            </div>
            <div class="col-md-8">
                <div class="user_content">
                    <div class="order_view">
                        <p class="order_notice">Order <span>#<?=($order->code)?></span> was placed on <span><?=date("M d,Y", strtotime($order->date))?></span> and is currently <span><?=ucfirst($order->status)?></span></p>
                        <h3>Order Details</h3>

                        <div class="table-responsive wishlist">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Discount</th>
                                        <th>Price</th>
                                        <th class="pl-0">Quantity</th>
                                        <th class="text-right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $total_amount = 0;
                                        if(!empty($order->order_items) && is_array($order->order_items)) foreach($order->order_items as $item) {
                                            $price = ($item->price * $item->quantity);
                                            $price = ($price - (($price/100)*$item->discount));

                                            $total_amount += $price;
                                    ?>
                                    <tr>
                                        <td><?=($item->title)?></td>
                                        <td><?=($item->discount)?></td>
                                        <td><?=($item->price)?></td>
                                        <td class="pl-0"><?=($item->quantity)?></td>
                                        <td class="text-right">৳<?=number_format($price, 2)?></td>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td class="border-bottom pl-0">Subtotal</td>
                                        <td class="border-bottom text-right">৳<?=number_format($total_amount, 2)?></td>
                                    </tr>
                                    <tr class="border-0">
                                        <td colspan="3" rowspan="3"></td>
                                        <td class="border-bottom pl-0">Shipping</td>
                                        <td class="border-bottom text-right">৳<?=($order->shipping_cost)?></td>
                                    </tr>
                                    <tr class="border-0">
                                        <td class="border-bottom">Payment method</td>
                                        <td class="border-bottom text-right"><?=ucfirst($order->trx_method)?></td>
                                    </tr>
                                    <tr class="border-0">
                                        <td>Total</td>
                                        <td class="text-right">৳<?=number_format(($total_amount+$order->shipping_cost), 2)?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- dashboard section end -->
