<div class="container-fluid">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>All Order</h1>
                </div>
            </div>
            <div class="panel-body">
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" name="search[code]" class="form-control" placeholder="Order ID">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="input-group date">
                                    <input type="text" name="search[from]" class="form-control" placeholder="From" autocomplete="off">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="input-group date">
                                    <input type="text" name="search[to]" class="form-control" placeholder="To" autocomplete="off">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select name="search[user_id]" class="form-control selectpicker" data-live-search="true">
                                    <option value="" selected disabled>Select A User</option>
                                    <?php if(!empty($users)) foreach($users as $row){ ?>
                                    <option value="<?=($row->id)?>"><?=($row->name)?> - <?=($row->mobile)?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select name="search[status]" class="form-control selectpicker" data-live-search="true">
                                    <option value="" selected disabled>Select A Staus</option>
                                    <option value="pending">Pending</option>
                                    <option value="processing">Processing</option>
                                    <option value="on_the_way">On The Way</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="submit" class="btn btn-info" value="Filter">
                            </div>
                        </div>
                    </div>
                </form>
                <hr style="margin-top: 0;">
                <?php msg();
                    if(!empty($orders)){
                ?>
                <table class="table table-bordered">
                    <tr>
                        <th width="40">SL</th>
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
                        <td class="text-right"><?=number_format($amount, 2)?> Tk</td>
                        <td><?=ucfirst(str_replace("_", " ", $row->status))?></td>
                        <td class="text-right">
                            <?php if($action_menus) {
                                foreach($action_menus as $action_menu) {
                                    if($user_data['privilege']=='president' xor (!empty($aside_action_menu_array) && in_array($action_menu->id,$aside_action_menu_array) && $user_data['privilege']!=='president')){
                                    if(strtolower($action_menu->name) == "delete" ){?>
                                        <a class="btn btn-<?php echo $action_menu->type;?>" onclick="return confirm('Are your sure to proccess this action ?')"  href="<?php echo get_url($action_menu->controller_path."/".$row->id); ?>"><i class="<?php echo $action_menu->icon;?>" aria-hidden="true"></i></a>
                                    <?php }else{ ?>
                                        <a class="btn btn-<?php echo $action_menu->type;?>"  href="<?php echo get_url($action_menu->controller_path."/".$row->id) ;?>"><i class="<?php echo $action_menu->icon;?>" aria-hidden="true"></i></a>
                                <?php }}}
                            } ?>
                        </td>
                    </tr>
                    <?php }; ?>
                    <tr>
                        <th colspan="6" class="text-right">Total</th>
                        <th class="text-center"><?=($total_item)?></th>
                        <th class="text-right" style="white-space: nowrap;"><?=number_format($total_amount, 2)?> Tk</th>
                        <th colspan="2"></th>
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
<script>
    // linking between two date
    $('.date').datetimepicker({
        format: 'YYYY-MM-DD',
        useCurrent: false
    });
</script>
