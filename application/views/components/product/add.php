<script type="text/javaScript" src="<?php echo site_url('private/js/ng-controller/addProductFn.js'); ?>"></script>
<style>
.feature_photo {
    width: 236px;
    height: 236px;
}
.feature_photo img{
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.set-photo-wrapper {
    position: relative;
    margin-bottom: 15px;
}
.set-photo-wrapper label {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
    z-index: 1;
}
.set-photo-wrapper span {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #00000052;
    font-size: 18px;
    font-weight: 800;
    color: #ffffff;
}
.photo-action {
    position: absolute;
    top: 0;
    right: 0;
    z-index: 2;
}
</style>
<div class="container-fluid" ng-controller="addProductFn">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>Add Product</h1>
                </div>
            </div>
            <div class="panel-body" ng-cloak>
                <?php msg(); ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Title <span class="req">*</span></label>
                                <input type="text" name="title" placeholder="Enter Product Title..." class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Brand <span class="req">*</span></label>
                                <select name="brand_id" class="form-control selectpicker" data-live-search="true" required>
                                    <option value="" selected disabled> --Select A Brand -- </option>
                                    <?php if(!empty($brands)) foreach($brands as $row){ ?>
                                        <option value="<?=($row->id)?>"><?=($row->brand)?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Category <span class="req">*</span></label>
                                <select name="cat_id" ng-model="cat_id" class="form-control selectpicker" data-live-search="true" required>
                                    <option value="" selected disabled> --Select A Category -- </option>
                                    <?php if(!empty($categories)) foreach($categories as $row){ ?>
                                        <option value="<?=($row->id)?>"><?=($row->category)?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Sub-Category <small>(<span id="total_cat">0</span>)</small><span class="req">*</span></label>
                                <select name="sub_cat_id" class="form-control" id="sub_cat_id" data-live-search="true">
                                    <option value="" selected disabled> --Select A Sub-Category -- </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Size <span class="req">*</span></label>
                                <select name="size_id[]" class="form-control selectpicker" multiple data-live-search="true">
                                    <option value="" disabled> --Select A Size -- </option>
                                    <?php if(!empty($sizes)) foreach($sizes as $row){ ?>
                                        <option value="<?=($row->id)?>"><?=($row->size)?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Color <span class="req">*</span></label>
                                <select name="color_id[]" class="form-control selectpicker" multiple data-live-search="true">
                                    <option value="" disabled> --Select A Color -- </option>
                                    <?php if(!empty($colors)) foreach($colors as $row){ ?>
                                        <option value="<?=($row->id)?>"><?=($row->color)?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Price <span class="req">*</span></label>
                                <input type="text" name="price" placeholder="Price" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Min-Qty <span class="req">*</span></label>
                                <input type="text" name="min_qty" placeholder="Min Sale Quantity" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Discount(%) <span class="req">*</span></label>
                                <input type="text" name="discount" value="0" placeholder="Discount(%)" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Warranty <span class="req">*</span></label>
                                <input type="text" name="warranty" placeholder="Warranty" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Feature Product<span class="req">*</span></label>
                                <select name="feature_product" class="form-control selectpicker" data-live-search="true">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Status <span class="req">*</span></label>
                                <select name="status" class="form-control selectpicker" data-live-search="true">
                                    <option value="available">Available</option>
                                    <option value="not_available">Not Available</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Description <span class="req">*</span></label>
                                <textarea name="description" class="form-control" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="set-photo-wrapper">
                                <div class="feature_photo">
                                    <img src="<?=site_url('public/images/thumbnail/photo.svg')?>" alt="">
                                </div>
                                <label for="feature_photo">
                                    <input type="file" id="feature_photo" onchange="fileLoadFn(this)" name="feature_photo" required>
                                </label>
                                <span>Feature Photo</span>
                            </div>
                        </div>

                        <div class="col-md-3" ng-repeat="photo in photos">
                            <div class="set-photo-wrapper">
                                <div class="feature_photo">
                                    <img src="{{photo.src}}" alt="">
                                </div>
                                <label><input type="file" name="photos[]" onchange="fileLoadFn(this)" data-index="{{$index}}" required></label>
                                <span>Choise A Photo</span>
                                <div class="photo-action">
                                    <div class="btn-group">
                                        <a href="javascript:void(0)" ng-click="addFn($index)" class="btn btn-info"><i class="fa fa-plus"></i></a>
                                        <a href="javascript:void(0)" ng-click="removeFn($index)" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
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