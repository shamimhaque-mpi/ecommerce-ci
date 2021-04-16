<div class="container-fluid">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>All Prodcut</h1>
                </div>
            </div>
            <div class="panel-body">
                <?php msg(); ?>
                <table class="table table-bordered">
                    <tr>
                        <th width="50">SL</th>
                        <th>Photo</th>
                        <th>Title</th>
                        <th>Min-QTY</th>
                        <th>Discount</th>
                        <th>Price</th>
                        <th>F. Product</th>
                        <th>Status</th>
                        <th width="160" class="none">Action</th>
                    </tr>
                   
                    <?php 
                    	$total_discount = $total_price = 0;
                    	if(!empty($products)){ foreach($products as $key => $row){ 
                    		$total_discount += $row->discount;
                    		$total_price += $row->price;
                    ?>
                    <tr>
                        <td><?=(++$key)?></td>
                        <td><img src="<?=site_url($row->small)?>" height="30"></td>
                        <td><?=($row->title)?></td>
                        <td class="text-right"><?=($row->min_qty)?></td>
                        <td class="text-right"><?=number_format($row->discount)?></td>
                        <td class="text-right"><?=number_format($row->price)?></td>
                        <td><?=filter($row->feature_product)?></td>
                        <td><?=filter($row->status)?></td>
                        <td class="none">
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
                    <?php }?>
                    <tr>
                    	<th colspan="4" class="text-right">Total</th>
                    	<td class="text-right"><?=number_format($total_discount)?></td>
                    	<td class="text-right"><?=number_format($total_price)?></td>
                    	<td></td>
                    	<td></td>
                    	<td></td>
                    </tr>

	                <?php } else { ?>
                    	<tr>
                    		<th colspan="4" class="text-center">Nothing Found</th>
                    	</tr>
                    <?php } ?>
                </table>
            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>