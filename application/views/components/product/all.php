<script type="text/javaScript" src="<?php echo site_url('private/js/ng-controller/allProductsController.js'); ?>"></script>
<style>
    .bootstrap-select.btn-group .dropdown-menu li {max-width: 420px;}
    .btn {
        padding-right: 12px;
        padding-left: 12px;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>All Prodcut</h1>
                </div>
            </div>
            <div class="panel-body" ng-controller="allProductsController">
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <select name="search[id]" class="form-control selectpicker" data-live-search="true">
                                    <option value="" selected disabled>Select Product</option>
                                    <?php if(!empty($all_product)) foreach($all_product as $row){ ?>
                                    <option value="<?=($row->id)?>"><?=($row->title)?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select name="search[brand_id]" id="" class="form-control selectpicker" data-live-search="true">
                                    <option value="" selected disabled>Select A Brand</option>
                                    <?php if(!empty($brands)) foreach($brands as $row){ ?>
                                    <option value="<?=($row->id)?>"><?=($row->brand)?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select name="search[cat_id]" ng-model="cat_id" class="form-control selectpicker" data-live-search="true">
                                    <option value="" selected disabled>Select Category</option>
                                    <?php if(!empty($categories)) foreach($categories as $row){ ?>
                                    <option value="<?=($row->id)?>"><?=($row->category)?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select name="search[sub_cat_id]" id="sub_cat_id" class="form-control" data-live-search="true">
                                    <option value="" selected disabled>Select Sub-Category</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select name="search[status]" id="" class="form-control selectpicker" data-live-search="true">
                                    <option value="" selected disabled>Select Status</option>
                                    <option value="available">Available</option>
                                    <option value="not_available">Not Available</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <input type="submit" class="btn btn-info" value="Filter">
                            </div>
                        </div>
                    </div>
                </form>
                <hr>
                <?php msg(); ?>
                <table class="table table-bordered">
                    <tr>
                        <th width="40">SL</th>
                        <th>Photo</th>
                        <th>Title</th>
                        <th>Brand</th>
                        <th>Category</th>
                        <th>M.QTY</th>
                        <th>Dis(%)</th>
                        <th>Price</th>
                        <th>F.Product</th>
                        <th>Status</th>
                        <th width="150" class="text-right">Action</th>
                    </tr>

                    <?php if(!empty($products)){ foreach($products as $key => $row){ ?>
                    <tr>
                        <td><?=(++$key)?></td>
                        <td><img src="<?=site_url($row->feature_photo)?>" height="30"></td>
                        <td><?=($row->title)?></td>
                        <td><?=($row->brand)?></td>
                        <td><?=($row->category)?></td>
                        <td class="text-center"><?=($row->min_qty)?></td>
                        <td class="text-center"><?=number_format($row->discount)?></td>
                        <td class="text-center"><?=number_format($row->price)?></td>
                        <td><?=filter($row->feature_product)?></td>
                        <td><?=filter($row->status)?></td>
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
                    <?php }} else { ?>
                    	<tr>
                    		<th colspan="11" class="text-center">Nothing Found</th>
                    	</tr>
                    <?php } ?>
                </table>
            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>
