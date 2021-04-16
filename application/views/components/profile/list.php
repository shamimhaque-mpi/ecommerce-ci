    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>All service</h1>
                </div>
            </div>
            <div class="panel-body">
                 <?php msg(); ?>
                <table class="table table-bordered">
                    <tr>
                        <th width="50">SL</th>
                        <th>Img</th>
                        <th>Company Name</th>
                        <th>Description</th>
                        <th width="150">Action</th>
                    </tr>
                   
                    <?php if($profile){ foreach($profile as $key => $value){ ?>
                    <tr>
                        <td><?php echo ++$key; ?></td>
                        <td><?php echo isset($value->path) ? "<img height='60' src='".site_url($value->path)."' alt=''" : ''; ?></td>
                        <td><?php echo isset($value->name) ? $value->name : ''; ?></td>
                        <td><?php echo isset($value->description) ? substr($value->description,0,100) : ''; ?>...</td>
                        <td>
                            <a href="<?php echo get_url("profile/profile/edit/{$value->id}"); ?>"><i class="fa fa-pencil-square-o btn btn-primary" aria-hidden="true"></i></a>

                             <a href="<?php echo get_url("profile/profile/delete/{$value->id}"); ?>" onclick="return confirm('Are your sure to proccess this action ?')"><i class="fa fa-trash-o btn btn-danger" aria-hidden="true"></i></td></a>
                    </tr>
                    <?php }} ?>
                </table>
            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>