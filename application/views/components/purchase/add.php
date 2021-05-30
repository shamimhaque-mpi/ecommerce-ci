<script type="text/javaScript" src="<?php echo site_url('private/js/ng-controller/addPurchaseController.js'); ?>"></script>
<style>
	.bootstrap-select.btn-group .dropdown-menu li {max-width: 420px;}
	table .btn {
		padding: 3px 16px!important;
		font-size: 22px;
		line-height: 22px;
	}
	tr > td {
		vertical-align: middle!important;
		padding: 0 3px!important;
	}
	tr > td > input {
		border: none!important;
        text-align: center;
	}
    .items tr > th, tr > td {text-align: center;}
    .panel-body {min-height: 61vh;}
    .text-left {text-align: left!important;}
    .text-right {text-align: right!important;}
    hr {margin-top: 4px;}
    .supplier_info .form-group {width: 100%;}
    .supplier_info {
		align-items: center;
        min-height: 72px;
        display: flex;
    }
	.supplier_info .form-group,
	.supplier_info li:first-child {margin-top: -5px;}
	.supplier_info li {margin: 6px 0;}
	.supplier_info li strong {
		display: inline-block;
		min-width: 70px;
	}
    .custom-border {border-left: 1px solid #dddddd;}
</style>
<div class="panel panel-default">
    <div class="panel-heading panal-header">
        <div class="panal-header-title pull-left">
            <h1>Add Purchase</h1>
        </div>
    </div>

    <div class="panel-body" ng-controller="addPurchaseController">
        <form action="" method="POST">
            <div class="row">
            	<div class="col-md-3">
					<div class="form-group">
	            		<select name="supplier_id" class="form-control selectpicker" ng-model="supplier_id" data-live-search="true">
	            			<option value="">Select Supplier</option>
	            			<?php if($suppliers) foreach($suppliers as $row){ ?>
	            				<option value="<?=($row->id)?>"><?=($row->name.'-'.$row->mobile)?></option>
	            			<?php } ?>
	            		</select>
	            	</div>
            	</div>

            	<div class="col-md-3">
					<div class="form-group">
	            		<select class="form-control selectpicker" ng-model="product_id" data-live-search="true" required>
	            			<option value="">Select Product</option>
	            			<?php if($products) foreach($products as $row){ ?>
	            				<option value="<?=($row->id)?>"><?=($row->title)?></option>
	            			<?php } ?>
	            		</select>
	            	</div>
            	</div>
            </div>

            <hr>

            <div class="row" ng-cloak>
            	<div class="col-md-9">
            		<table class="table table-bordered items">
            			<tr>
            				<th width="50">SL</th>
            				<th class="text-left">Title</th>
            				<th width="80">P.Price</th>
            				<th width="80">S.Price</th>
            				<th width="80">Qty</th>
            				<th width="80">Total</th>
            				<th width="60">Action</th>
            			</tr>
            			<tr ng-repeat="item in cart">
            				<th>{{$index+1}}</th>
            				<td class="text-left">{{item.title}}</td>
            				<td>{{+item.price}}</td>
            				<td>
                                <input type="hidden" name="product_id[]"     ng-value="item.id">
                                <input type="hidden" name="purchase_price[]" ng-value="item.price">
                                <input type="text"   name="sale_price[]"     ng-model="item.sale_price" class="form-control">
                            </td>
            				<td><input type="text" name="quantity[]" ng-model="item.qty" class="form-control"></td>
            				<td><input type="text" name="total[]" ng-value="getsum($index)" class="form-control" readonly></td>
            				<td>
            					<div class="btn-group">
            						<a href="javaScript:void(0)" ng-click="remove($index)" class="btn btn-danger">&times;</a>
            					</div>
            				</td>
            			</tr>
                        <tr ng-show="cart.length>0">
                            <th colspan="2" class="text-right">Total</th>
                            <td><input type="text" class="form-control" ng-value="total.p_price" readonly></td>
                            <td><input type="text" class="form-control" ng-value="total.s_price" readonly></td>
                            <td><input type="text" class="form-control" name="total_qty" ng-value="total.qty" readonly></td>
                            <td><input type="text" class="form-control" name="sub_total" ng-value="getSubTotal()" readonly></td>
                            <td></td>
                        </tr>
                        <tr ng-show="cart.length==0">
                            <td colspan="7" style="padding: 9px!important;">Nothing Selected</td>
                        </tr>
            		</table>
            	</div>
                <div class="col-md-3 custom-border">
                    <div class="supplier_info">
                        <ul ng-show="supplier">
                            <li><strong>Name</strong>: {{supplier.name}}</li>
                            <li><strong>Mobile</strong>: {{supplier.mobile}}</li>
                            <li><strong>Balance</strong>: {{supplier.balance}}({{(supplier.balance>0?'Payable':'Receivable')}})</li>
                        </ul>
						<div ng-show="!supplier" class="form-group">
							<label>Supplier Name <strong class="text-danger">*</strong></label>
							<input class="form-control" name="supplier_name" type="text" ng-required="!supplier">
						</div>
                    </div>
                    <hr>
                    <div>
                        <table class="table table-bordered">
                            <tr>
                                <th width="120">Sub-Total</th>
                                <td><input type="text" name="sub_total" ng-model="total.sub_total" class="form-control" readonly></td>
                            </tr>
                            <tr>
                                <th width="120">Discount(%)</th>
                                <td><input type="text" ng-model="credential.discount" name="discount" class="form-control"></td>
                            </tr>
                            <tr>
                                <th>Grand Total</th>
                                <td><input type="text" ng-value="getGrandTotal()" name="grand_total" class="form-control" readonly></td>
                            </tr>
                            <tr>
                                <th>Paid</th>
                                <td><input type="text" ng-model="credential.paid" name="paid" class="form-control"></td>
                            </tr>
                            <tr>
                                <th>Due</th>
                                <td><input type="text" ng-model="credential.due" class="form-control" readonly></td>
                            </tr>
                            <tr ng-show="supplier_id">
                                <th>C. Balance</th>
                                <td><input type="text" ng-model="credential.balance" class="form-control" readonly></td>
                            </tr>
                        </table>
                    </div>
                    <div class="text-right" ng-show="(credential.due==0 || supplier_id!='')">
                        <input type="submit" value="Save" class="btn btn-success">
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="panel-footer">&nbsp;</div>
</div>
