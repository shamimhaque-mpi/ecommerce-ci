<div class="container-fluid">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>Edit Slider</h1>
                </div>
            </div>
            <div class="panel-body">
                <?php
                    msg();
                    if($slider==false){
                ?>
                <div class="alert alert_warning">
                    <div class="icon"><i class="fa fa-exclamation-triangle"></i></div>
	                <div class="content">
	                    <div>
	                        <strong>Warning!</strong> <br>
	                    </div>
	                    <div>No Resoult Found !</div>
	                </div>
	            </div>
                <?php return; } ?>

                <?php $id = isset($slider[0]->id) ? $slider[0]->id : ''; ?>
                <form action="<?php echo get_url("slider/slider_controller/edit_process/$id"); ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Slider Name <span class="req">*</span></label>
                        <div class="col-md-5">
                            <input type="text" name="name" value="<?php echo isset($slider[0]->name) ? $slider[0]->name : ''; ?>" placeholder="Enter Slider Name..." class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Photos</label>
                        <div class="col-md-5">
                            <input type="hidden" name="old_img" value="<?php echo isset($slider[0]->path) ? $slider[0]->path : ''; ?>" >
                            <input type="file" name="img" class="form-control">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-2 control-label">Is Offer <span class="req">*</span></label>
                        <div class="col-md-5">
                            <input type="checkbox" name="is_offer" value="1" <?=($slider[0]->is_offer==1 ? 'checked' : ''); ?>>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-7">
                            <div class="pull-right">
                                <input type="submit" value="Update" class="btn btn-primary">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"></label>
                        <div class="col-md-5">
                           <img src="<?php echo site_url($slider ? $slider[0]->path : '')?>" style="display:block; width:100px;" alt="">
                        </div>
                    </div>
                </form>
            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>
