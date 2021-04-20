<div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>Edit Supplier</h1>
                </div>
            </div>

            <div class="panel-body">
                <form action="" method="POST" class="form-horizontal">
	                <div class="form-group">
	                    <label class="col-md-3 control-label">Name<span class="req">&nbsp;*</span></label>
	                    <div class="col-md-5">
	                        <input type="text" name="name" value="<?=($edit->name)?>" class="form-control" required="">
	                    </div>
	                </div>

	                <div class="form-group">
	                    <label class="col-md-3 control-label">Mobile<span class="req">&nbsp;*</span></label>
	                    <div class="col-md-5">
	                        <input type="text" name="mobile" value="<?=($edit->mobile)?>" class="form-control" required="">
	                    </div>
	                </div>

	                <div class="form-group">
	                    <label class="col-md-3 control-label">Address </label>
	                    <div class="col-md-5">
	                        <textarea name="address" cols="15" rows="5" class="form-control"><?=($edit->address)?></textarea>
	                    </div>
	                </div>

	                <div class="form-group">
	                    <label class="col-md-3 control-label">Initial Balance (TK) <span class="req">&nbsp;*</span></label>
	                    <div class="col-md-3">
	                        <input type="number" name="initial_balance" value="<?=abs($edit->initial_balance)?>" class="form-control" min="0" step="any" value="0.00" required="">
	                    </div>

	                    <div class="col-md-2">
	                        <select name="type" class="form-control">
	                            <option value="receivable" <?=($edit->type=="receivable"?"selected":"")?>>Receivable</option>
	                            <option value="payable" <?=($edit->type=="payable"?"selected":"")?>>Payable</option>
	                        </select>
	                    </div>
	                </div>

	                <div class="col-md-8">
	                    <div class="btn-group pull-right">
	                        <input type="submit" value="Save" class="btn btn-primary">
	                    </div>
	                </div>
                </form>           
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>