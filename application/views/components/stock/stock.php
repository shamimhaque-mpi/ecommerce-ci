<div class="container-fluid">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>Stock</h1>
                </div>
            </div>
            <div class="panel-body">
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <select name="product_id" id="supplier_id" class="form-control selectpicker" data-live-search="true">
                                    <option value="" selected disabled>Select Supplier</option>
                                    <?php if(!empty($allProducts)) foreach($allProducts as $row){ ?>
                                        <option value="<?=($row->id)?>"><?=($row->title)?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="submit" class="btn btn-info" value="Search">
                            </div>
                        </div>
                    </div>
                </form>

                <hr style="margin-top: 0;"/>

                <table class="table table-bordered">
                    <tr>
                        <th width="50" class="text-center">SL</th>
                        <th>Product</th>
                        <th>Purchase Price</th>
                        <th>Sale Price</th>
                        <th>Quantity</th>
                    </tr>
                    <?php
                        if(!empty($stock)) foreach($stock as $key=>$row){
                    ?>
                    <tr>
                        <td class="text-center"><?=(++$key)?></td>
                        <td><?=($row->title)?></td>
                        <td><?=($row->purchase_price)?></td>
                        <td><?=($row->sale_price)?></td>
                        <td><?=($row->quantity)?></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>
