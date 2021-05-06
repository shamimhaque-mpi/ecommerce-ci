<div class="container-fluid">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>All Complete Order</h1>
                </div>
            </div>
            <div class="panel-body">
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
                        <th class="text-right">Items</th>
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
                        <td class="text-right"><?=($row->items)?></td>
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
                        <td class="text-right"><?=($total_item)?></td>
                        <td class="text-right">৳<?=number_format($total_amount, 2)?></td>
                        <td colspan="2"></td>
                    </tr>
                </table>
                <?php } else { ?>
                    <h3>Orders Not Founds</h3>
                <?php }?>
            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>
