<div class="container-fluid">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>Add Color</h1>
                </div>
            </div>
            <div class="panel-body">
                <?php msg(); ?>
                <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Color Name <span class="req">*</span></label>
                        <div class="col-md-7">
                            <input type="text" name="color" placeholder="Enter Color Name" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Color Code <span class="req">*</span></label>
                        <div class="col-md-7">
                            <input type="text" name="color_code" placeholder="Enter Hex Color Code (#e20606)" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <div class="pull-right">
                                <input type="submit" value="Save" class="btn btn-primary">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>
