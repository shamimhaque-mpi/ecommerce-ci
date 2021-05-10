<style>
    .gallery_area {position: relative;}
    .gallery_content {
        position: absolute;
        width: 100%;
        left: 0;
        top: 0;
    }
    .gallery_content iframe,
    .gallery_content img {
        border: none;
        width: 100%;
    }
    .gallery_content .image_box {
        border: 1px solid #ccc;
        margin-bottom: 40px;
        position: relative;
    }
    .gallery_content .img_cover {
        position: absolute;
        width: 100%;
        left: 0;
        top: 0;
        text-align: right;
    }
    .mce-edit-area {border-width: thin !important;}
</style>

<div class="container-fluid">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>Pages</h1>
                </div>
            </div>
            <div class="panel-body">
                <?php msg(); ?>
                <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Pages <span class="req">*</span></label>
                        <div class="col-md-7">
                            <select name="page" id="page" class="form-control">
                                <option value="privacy_policy">Privacy Policy</option>
                                <option value="trams">Trams</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div class="gallery_area">
                                <div class="gallery_content">
                                    <div class="hide img_show">
                                        <div class="image_box">
                                            <img class=" img_path" src="" alt="">
                                            <div class="img_cover">
                                                <a class="btn btn-danger img_delete"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Description <span class="req">*</span></label>
                        <div class="col-md-7">
                            <textarea  name="description" rows="15"  placeholder="Enter Description..." class="form-control description" id="mytextarea"></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="0" id="page_id" >
                    <div class="row">
                        <div class="col-md-9 text-right">
                            <input type="submit" id="submit_btn"  class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>

