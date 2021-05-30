<style>
    .invoice_header {
        justify-content: space-between;
        align-items: flex-start;
        min-height: 90px;
        display: flex;
        margin-bottom: 20px;
    }
    .invoice_header img {max-width: 220px !important;}
    .user_info {
        flex-wrap: wrap;
        display: flex;
        width: 100%;
        margin: 15px 0;
    }
    .user_info li {
        min-width: 160px;
        margin: 3px 0;
        width: 33.33%;
    }
    .user_info li strong {
        display: inline-block;
        min-width: 90px;
    }
    .table_title {
        margin: 15px 0 12px;
        font-weight: 600;
    }
    .table tr th,
    .table tr td {padding-left: 0 !important;}
    .table tr th:last-child,
    .table tr td:last-child {padding-right: 0;}
    .print_signature {
        justify-content: space-between;
        align-items: flex-end;
        width: 100%;
        min-height: 120px;
        display: flex !important;
    }
    .print_signature h4 {
        border-top: 2px dashed #717171;
        display: inline-block;
        font-size: 16px;
        color: #717171;
        margin: 0;
        padding: 5px 0;
    }
    @media print {
        .print_body {padding-bottom: 120px;}
        .table tr th,
        .table tr td {
            padding-bottom: 2px !important;
            padding-top: 2px !important;
        }
    }
</style>
<?php if($record){ ?>
<div class="container-fluid">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title">
                    <h1 class="pull-left">Purchase Invoice</h1>
                    <a class="pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i> Print</a>
                </div>
            </div>
            <div class="panel-body print_body">
                <div class="hide">
                    <div class="invoice_header">
                        <img src="<?=site_url('public/images/logo/logo.png')?>" alt="">
                        <h4 class="table_title">Purchase Invoice</h4>
                    </div>
                </div>
                <ul class="user_info">
                    <li><strong>Name</strong> : <?=($record->name ? $record->name : $record->supplier_name)?></li>
                    <li><strong>Mobile</strong> : <?=($record->mobile ? $record->mobile : 'N/A')?></li>
                    <li><strong>Address</strong> : <?=($record->address ? $record->address : 'N/A')?></li>
                </ul>
			    <div class="table-responsive">
			        <table class="table">
		                <tr>
		                    <th>SL</th>
                            <th>Product</th>
		                    <th>Price</th>
		                    <th>Quantity</th>
		                    <th class="text-right">Total</th>
		                </tr>
                        <?php 
                            $total = 0;
                            if($items) foreach($items as $key=>$row){ 
                                $total += ($row->purchase_price * $row->quantity);
                            ?>
                        <tr>
                            <td><?=(++$key)?></td>
                            <td><?=($row->title)?></td>
                            <td><?=($row->purchase_price)?></td>
                            <td><?=($row->quantity)?></td>
                            <td class="text-right">৳<?=number_format(($row->purchase_price * $row->quantity), 2)?></td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="3" rowspan="4"></td>
                            <td class="border-bottom">Subtotal</td>
                            <td class="border-bottom text-right">৳<?=number_format($total, 2)?></td>
                        </tr>

                        <tr class="border-0">
                            <td>Discount</td>
                            <td class="text-right"><?=number_format($record->discount,2)?></td>
                        </tr>
                        
                        <tr class="border-0">
                            <td>Grand Total</td>
                            <td class="text-right">৳<?=number_format($record->sub_total,2)?></td>
                        </tr>
                        
                        <tr class="border-0">
                            <td>Paid</td>
                            <td class="text-right">৳<?=number_format($record->paid,2)?></td>
                        </tr>

			        </table>
			    </div>

                <div class="print_signature hide">
                    <div class="signature_box"></div>
                    <div class="signature_box">
                        <h4>Authority Signature</h4>
                    </div>
                </div>
            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>
<?php }else { ?>
    <h2>SOMETHING IS WRONG</h2>
<?php } ?>
