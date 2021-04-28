<style>
    .file-upload {
        width: 100%;
        margin-bottom: 12px;
    }
    .file-upload .image-upload-wrap {
        padding: 20px 20px 25px;
        border: 2px dashed #ccc;
        position: relative;
        width: 100%;
        height: 175px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .file-upload .image-upload-wrap input {
        position: absolute;
        margin: 0;
        padding: 0;
        width: 100% !important;
        height: 100% !important;
        outline: none;
        opacity: 0;
        left: 0;
        top: 0;
        cursor: pointer;
    }
    .file-upload .image-upload-wrap h5 {
        text-transform: uppercase;
        color: #232323;
        margin-bottom: 0;
        font-size: 14px;
    }
    .file-upload .image-upload-wrap i {
        font-size: 45px;
        line-height: 40px;
        color: #00A8FF;
    }
    .file-upload .file-upload-content {
        padding: 2px;
        border: 2px dashed #ccc;
        height: 175px;
        display: none;
        position: relative;
        text-align: center;
    }
    .file-upload .file-upload-content img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .file-upload .file-upload-content .remove-image {
        cursor: pointer;
        line-height: 32px;
        height: 32px;
        width: 32px;
        text-align: center;
        position: absolute;
        top: 2px;
        right: 2px;
        font-size: 20px;
        color: #fff;
        background: #00A8FF;
        transition: all 0.2s ease;
        outline: none;
        border: none;
    }
    .file-upload .file-upload-btn {
        cursor: pointer;
        width: 100%;
        height: 40px;
        line-height: 36px;
        font-weight: 500;
        color: #00A8FF;
        background: none;
        font-size: 14px;
        border: 2px dashed #ccc;
        transition: all 0.2s ease;
        outline: none;
        text-transform: uppercase;
        margin-top: 3px;
    }
    input[type=checkbox] {
        vertical-align: middle;
        margin: 0px 0 0 4px;
        display: inline-block;
    }
</style>


<div class="container-fluid">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>Add Slider</h1>
                </div>
            </div>
            <div class="panel-body">
                <?php msg(); ?>
                <form action="<?php echo get_url("slider/slider_controller/add_process"); ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-6">
                            <label class="control-label">Photos <span class="req">*</span></label>
                            <div class="form-group">
                                <div class="file-upload">
                                    <div class="image-upload-wrap">
                                        <input class="file-upload-input" type="file" name="img" accept="image/*" required>
                                        <div>
                                            <i class="fa fa-upload"></i>
                                            <h5>Drag files to upload</h5>
                                            <h5>Or</h5>
                                            <h5>Click here</h5>
                                        </div>
                                    </div>
                                    <div class="file-upload-content">
                                        <img class="file-upload-image" src="#" alt="your image">
                                        <button type="button" class="remove-image"><i class="fa fa-close"></i></button>
                                    </div>
                                    <button class="file-upload-btn" type="button">Click here</button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Is Offer <span class="req">*</span></label>
                                <input type="checkbox" name="is_offer" value="1">
                            </div>
                            <div class="form-group text-right">
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
