<div class="container-fluid">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>All Category</h1>
                </div>
            </div>
            <div class="panel-body">
                <?php msg(); ?>
                <table class="table table-bordered">
                    <tr>
                        <th width="50">SL</th>
                        <th width="70">Img</th>
                        <th>Name</th>
                        <th width="120" class="none">Action</th>
                    </tr>
                   
                    <?php if(!empty($categories)){ foreach($categories as $key => $row){ ?>
                    <tr>
                        <td><?=(++$key)?></td>
                        <td><img src="<?=site_url($row->img)?>" width="60" alt=""></td>
                        <td><?=($row->category)?></td>
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
                    <?php }}else { ?>
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