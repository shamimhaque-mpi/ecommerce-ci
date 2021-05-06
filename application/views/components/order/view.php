<style>	
p.order-notice span {
    background: #dddddd61;
    padding: 4px 6px;
}
p.order-notice {
    margin-bottom: 40px;
}
</style>

<div class="container-fluid">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title">
                    <h1 class="pull-left">Invoice</h1>
                    <a class="pull-right" style="font-size: 14px; margin-top: 0;"
                       onclick="window.print()"><i class="fa fa-print"></i> Print</a>
                </div>
            </div>
            <div class="panel-body">
				<div class="order-view">
				    <p class="order-notice">Order <span class="pl-0">#<?=($order->code)?></span> was placed on <span><?=date("M d,Y", strtotime($order->date))?></span> and is currently <span><?=ucfirst($order->status)?></span></p>
				    <h4>User Details</h4>
                    <table class="table">
                        <tr>
                            <th>Name</th>
                            <td><?=($order->name)?></td>

                            <th>Mobile</th>
                            <td><?=($order->mobile)?></td>

                            <th>Address</th>
                            <td><?=($order->address)?></td>
                        </tr>
                    </table>
                    <h4>Order Details</h4>
				    <div class="table-responsive wishlist">
				        <table class="table">
				            <thead>
				                <tr>
				                    <th scope="col">SL</th>
                                    <th scope="col">Product</th>
				                    <th scope="col">Discount</th>
				                    <th scope="col">Price</th>
				                    <th scope="col">Quantity</th>
				                    <th scope="col" class="text-right">Total</th>
				                </tr>
				            </thead>
				            <tbody>
				                <?php 
                                    $total_amount = 0;
                                    if(!empty($order->order_items) && is_array($order->order_items)) foreach($order->order_items as $key=>$item) { 
                                        $price = ($item->price * $item->quantity);
                                        $price = ($price - (($price/100)*$item->discount));

                                        $total_amount += $price;
                                ?>
                                <tr>
                                    <td><?=(++$key)?></td>
                                    <td><?=($item->title)?></td>
                                    <td><?=($item->discount)?></td>
                                    <td><?=($item->price)?></td>
                                    <td><?=($item->quantity)?></td>
                                    <td class="text-right">৳<?=number_format($price, 2)?></td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="4"></td>
                                    <td class="border-bottom">Subtotal</td>
                                    <td class="border-bottom text-right">৳<?=number_format($total_amount, 2)?></td>
                                </tr>
                                <tr class="border-0">
                                    <td colspan="4" rowspan="3"></td>
                                    <td class="border-bottom">Shipping</td>
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
                    <div class="order-status-btn">
                        <p>Status Update</p>
                        <!-- <ul>
                            <li><a href="£">Pending</a></li>
                            <li><a href="£">Processing</a></li>
                            <li><a href="£">On the Way</a></li>
                            <li><a href="£">Shipped</a></li>
                        </ul> -->

                        <div class="btn-group">
  <button type="button" class="btn btn-primary">Apple</button>
  <button type="button" class="btn btn-primary">Samsung</button>
  <button type="button" class="btn btn-primary">Sony</button>
</div>

                    </div>
				</div>
                <hr>
                <?php 
                    msg(); 
                    if(!empty($orders)){ 
                ?>
                <caption>Orders & Shipping Details</caption>
                <table class="table table-bordered">
                    <tr>
                        <th width="50">SL</th>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Address</th>
                        <th class="text-center">Items</th>
                        <th class="text-right">Total</th>
                        <th>Status</th>
                        <th width="120" class="none text-right">Action</th>
                    </tr>
                    <?php 
                        $total_item = $total_amount = 0;
                        foreach ($orders as $key => $row) {
                            $amount       = ($row->amount + $row->shipping_cost);
                            $total_amount += $amount;
                            $total_item   += $row->items;
                    ?>
                    <tr>
                        <td><?=(++$key)?></td>
                        <td>#<?=($row->code)?></td>
                        <td><?=($row->date)?></td>
                        <td><?=($row->name)?></td>
                        <td><?=($row->mobile)?></td>
                        <td><?=($row->address)?></td>
                        <td class="text-center"><?=($row->items)?></td>
                        <td class="text-right">৳<?=number_format($amount, 2)?></td>
                        <td><?=ucfirst($row->status)?></td>
                        <td class="text-right">
                            <?php
                                if($action_menus){
                                    foreach($action_menus as $action_menu){
                                        if($user_data['privilege']=='president' xor (!empty($aside_action_menu_array) && in_array($action_menu->id,$aside_action_menu_array) && $user_data['privilege']!=='president')){
                                        // -----------------------------------------------------------
                                        if(strtolower($action_menu->name) == "delete" ){?>
                                            <a class="btn btn-<?php echo $action_menu->type;?>" onclick="return confirm('Are your sure to proccess this action ?')"  href="<?php echo get_url($action_menu->controller_path."/".$row->id); ?>"><i class="<?php echo $action_menu->icon;?>" aria-hidden="true"></i></a>
                                        <?php }else{ ?>
                                            <a class="btn btn-<?php echo $action_menu->type;?>"  href="<?php echo get_url($action_menu->controller_path."/".$row->id) ;?>"><i class="<?php echo $action_menu->icon;?>" aria-hidden="true"></i></a>
                                        <!---------------------------------------->
                            <?php }}}} ?>
                        </td>
                    </tr>  
                    <?php }; ?>
                    <tr>
                        <td colspan="6" class="text-right">Total</td>
                        <td class="text-center"><?=($total_item)?></td>
                        <td class="text-right">৳<?=number_format($total_amount, 2)?></td>
                        <td colspan="2"></td>
                    </tr>
                </table>
                <?php }?>
            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>


<style>
    

    .btn-group {}

    .btn-group button {
        position: relative;
    }

    .btn-group button:before {
        content: "";
        position: absolute;
        width: 1px;
        height: 22px;
        background: #fff;
        top: -3px;
        right: 8px;
        transform: rotate(130deg);
    }
    .btn-group button:after {
        content: "";
        position: absolute;
        width: 1px;
        height: 22px;
        background: #fff;
        top: 13px;
        right: 8px;
        transform: rotate(45deg);
    }
</style>