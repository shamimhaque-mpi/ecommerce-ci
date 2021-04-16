        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>All Message</h1>
                </div>
            </div>
            <div class="panel-body">
                 <?php msg(); ?>
                <table class="table table-bordered">
                    <tr>
                        <th width="50">SL</th>
                        <th>Name</th>
                        <th>Email</th>
                        <!--<th>Subject</th>-->
                        <th>Message</th>
                        <th>Action</th>
                    </tr>
                   
                    <?php if($message){ foreach($message as $key => $value){ ?>
                    <tr>
                        <td><?php echo ++$key; ?></td>
                        <!--<td><?php echo isset($value->path) ? "<img height='60' src='".site_url($value->path)."' alt=''" : ''; ?></td>-->
                        <td><?php echo isset($value->name) ? $value->name : ''; ?></td>
                        <td><?php echo isset($value->email) ? $value->email : ''; ?></td>
                        <!--<td><?php echo isset($value->subject) ? $value->subject : ''; ?></td>-->
                        <td><?php echo isset($value->message) ? substr($value->message,0,50) : ''; ?>...</td>
                        <td width="115">
                            <a class="btn btn-primary" href="<?php echo get_url("message/message/m_view/{$value->id}"); ?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <a class="btn btn-danger" href="<?php echo get_url("message/message/delete/{$value->id}"); ?>" onclick="return confirm('Are your sure to proccess this action ?')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    <?php }} ?>
                </table>
            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>