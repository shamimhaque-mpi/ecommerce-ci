<script type="text/javaScript" src="<?php echo site_url('private/js/ng-controller/allProductsController.js'); ?>"></script>
<div class="container-fluid">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>All Purchase</h1>
                </div>
            </div>
            <div class="panel-body" ng-controller="allProductsController">
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="input-group date" id="datetimepickerSMSFrom">
                                    <input type="text" name="search[from]" class="form-control" placeholder="From" autocomplete="off">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="input-group date" id="datetimepickerSMSTo">
                                    <input type="text" name="search[to]" class="form-control" placeholder="To" autocomplete="off">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select name="search[supplier_id]" id="supplier_id" class="form-control selectpicker" data-live-search="true">
                                    <option value="" selected disabled>Select A Supplier</option>
                                    <?php if(!empty($suppliers)) foreach($suppliers as $row) { ?>
                                        <option value="<?=($row->id)?>"><?=($row->name)?> - <?=($row->mobile)?></option>
                                    <?php } ?>
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

                <?php msg(); ?>
                <table class="table table-bordered">
                    <tr>
                        <th width="50" class="text-center">SL</th>
                        <th>Date</th>
                        <th>Supplier</th>
                        <th>Discount</th>
                        <th>Quantity</th>
                        <th>Grand Total</th>
                        <th>Paid</th>
                        <th width="160" class="text-right">Action</th>
                    </tr>
                    <?php
                        $total_qty = $grand_total = $total_paid = 0;
                        if(!empty($records)) foreach($records as $key=>$row){
                            $total_qty   += $row->total_qty;
                            $grand_total += $row->grand_total;
                            $total_paid  += $row->paid;
                    ?>
                    <tr>
                        <th class="text-center"><?=(++$key)?></th>
                        <td><?=($row->date)?></td>
                        <td><?=($row->supplier_name!='' ? $row->supplier_name : $row->name)?></td>
                        <td><?=($row->discount)?>%</td>
                        <td><?=($row->total_qty)?></td>
                        <td><?=($row->grand_total)?></td>
                        <td><?=($row->paid)?></td>
                        <td class="text-right">
                            <?php
                                if($action_menus){
                                    foreach($action_menus as $action_menu){
                                        if($user_data['privilege']=='president' xor (!empty($aside_action_menu_array) && in_array($action_menu->id,$aside_action_menu_array) && $user_data['privilege']!=='president')){
                                        if(strtolower($action_menu->name) == "delete" ){?>
                                            <a class="btn btn-<?php echo $action_menu->type;?>" onclick="return confirm('Are your sure to proccess this action ?')"  href="<?php echo get_url($action_menu->controller_path."/".$row->id); ?>"><i class="<?php echo $action_menu->icon;?>" aria-hidden="true"></i></a>
                                        <?php }else{ ?>
                                            <a class="btn btn-<?php echo $action_menu->type;?>"  href="<?php echo get_url($action_menu->controller_path."/".$row->id) ;?>"><i class="<?php echo $action_menu->icon;?>" aria-hidden="true"></i></a>
                                    <?php }}}
                                }?>
                        </td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <th colspan="4" class="text-right">Total</th>
                        <th><?=($total_qty)?></th>
                        <th><?=($grand_total)?>TK</th>
                        <th><?=($total_paid)?>TK</th>
                        <th></th>
                    </tr>
                </table>
            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>
<script>
    // linking between two date
    $('#datetimepickerSMSFrom').datetimepicker({
        format: 'YYYY-MM-DD',
        useCurrent: false
    });
    $('#datetimepickerSMSTo').datetimepicker({
        format: 'YYYY-MM-DD',
        useCurrent: false
    });
</script>
