<style>
    p.order-notice {margin-bottom: 25px;}
    p.order-notice span {
        background: #ECEFF4;
        font-size: 12px;
        padding: 2px 6px;
        border-radius: 4px;
        text-transform: uppercase;
    }
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
    @page {margin: 0;}
    @media print {
        .table tr th,
        .table tr td {
            padding-bottom: 2px !important;
            padding-top: 2px !important;
        }
    }

    .order-status-btn .btn-breadcrumb {
        border-top: 1px solid #ddd;
        padding-top: 12px;
        width: 100%;
        text-transform: capitalize;
    }
    .btn-breadcrumb .btn:not(:last-child):before,
    .btn-breadcrumb .btn:not(:last-child):after {
        position: absolute;
        display: block;
        content: " ";
        width: 0;
        height: 0;
        top: 50%;
        z-index: 3;
        left: 100%;
        margin-top: -17px;
    }
    .btn-breadcrumb .btn:not(:last-child):after {
        border-bottom: 17px solid transparent;
        border-top: 17px solid transparent;
        border-left: 10px solid white;
    }
    .btn-breadcrumb .btn:not(:last-child):before {
        border-left: 10px solid rgb(173, 173, 173);
        border-bottom: 17px solid transparent;
        border-top: 17px solid transparent;
        margin-left: 1px;
    }
    .btn-breadcrumb .btn:first-child {padding:6px 6px 6px 10px;}
    .btn-breadcrumb .btn:last-child {padding:6px 18px 6px 24px;}
    .btn-breadcrumb .btn {
        padding: 6px 12px 6px 24px;
        box-shadow: none;
        outline: none;
    }
    .btn-breadcrumb .btn:focus {
        padding: 7px 12px 7px 24px;
        box-shadow: none;
        outline: none;
    }
    .btn-breadcrumb .btn.btn-default:not(:last-child):after {border-left: 10px solid #fff;}
    .btn-breadcrumb .btn.btn-default:not(:last-child):before {border-left: 10px solid #ccc;}
    .btn-breadcrumb .btn.btn-default:hover:not(:last-child):after {border-left: 10px solid #ebebeb;}
    .btn-breadcrumb .btn.btn-default:hover:not(:last-child):before {border-left: 10px solid #adadad;}
    .btn-breadcrumb .btn.btn-primary:not(:last-child):after {border-left: 10px solid #337ab7;}
    .btn-breadcrumb .btn.btn-primary:not(:last-child):before {border-left: 10px solid #337ab7;}

    .btn-breadcrumb .btn.btn-primary:focus:not(:last-child):before,
    .btn-breadcrumb .btn.btn-primary:hover:not(:last-child):before {border-left: 10px solid #286090;}
    .btn-breadcrumb .btn.btn-primary:focus:not(:last-child):after,
    .btn-breadcrumb .btn.btn-primary:hover:not(:last-child):after {border-left: 10px solid #286090;}
</style>

<div class="container-fluid">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title">
                    <h1 class="pull-left">Invoice</h1>
                    <a class="pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i> Print</a>
                </div>
            </div>
            <div class="panel-body">
			    <p class="order-notice">Order <span class="pl-0">#<?=($order->code)?></span> was placed on <span><?=date("M d,Y", strtotime($order->date))?></span> and is currently <span id="top_status"></span></p>
                <ul class="user_info">
                    <li><strong>Name</strong> : <?=($order->name)?></li>
                    <li><strong>Mobile</strong> : <?=($order->mobile)?></li>
                    <li><strong>Address</strong> : <?=($order->address)?></li>
                </ul>
                <h4 class="table_title">Order Details</h4>
			    <div class="table-responsive">
			        <table class="table">
		                <tr>
		                    <th>SL</th>
                            <th>Product</th>
		                    <th>Discount</th>
		                    <th>Price</th>
		                    <th>Quantity</th>
		                    <th class="text-right">Total</th>
		                </tr>
		                <?php $total_amount = 0;
                        if(!empty($order->order_items) && is_array($order->order_items)) foreach($order->order_items as $key=>$item) {
                            $price = ($item->price * $item->quantity);
                            $price = ($price - (($price/100)*$item->discount));
                            $total_amount += $price; ?>
                            <tr>
                                <td><?=(++$key)?></td>
                                <td><?=($item->title)?></td>
                                <td><?=($item->discount)?></td>
                                <td><?=($item->price)?></td>
                                <td><?=($item->quantity)?></td>
                                <td class="text-right">৳<?=number_format($price, 2)?></td>
                            </tr>
                            <?php
                        }?>
                        <tr>
                            <td colspan="4"></td>
                            <td class="border-bottom">Subtotal</td>
                            <td class="border-bottom text-right">৳<?=number_format($total_amount, 2)?></td>
                        </tr>
                        <tr class="border-0">
                            <td colspan="4" rowspan="3"></td>
                            <td class="border-bottom">Shipping</td>
                            <td class="border-bottom text-right">৳<?=($order->shipping_cost)?></td>
                        </tr>
                        <tr class="border-0">
                            <td class="border-bottom">Payment method</td>
                            <td class="border-bottom text-right"><?=ucfirst($order->trx_method)?></td>
                        </tr>
                        <tr class="border-0">
                            <td>Total</td>
                            <td class="text-right">৳<?=number_format(($total_amount+$order->shipping_cost), 2)?></td>
                        </tr>
			        </table>
			    </div>
                <div class="order-status-btn none">
                        <p>Status Update</p>
                        <div class="btn-group btn-breadcrumb">
                            <a href="javascript:void(0)" data-status="pending" class="btn btn-default order_status">Pending</a>
                            <a href="javascript:void(0)" data-status="processing" class="btn btn-default order_status">Processing</a>
                            <a href="javascript:void(0)" data-status="on_the_way" class="btn btn-default order_status">On the Way</a>
                            <a href="javascript:void(0)" data-status="shipped" class="btn btn-default order_status">Shipped</a>
                        </div>
                    </div>

                <hr>

                <?php msg();
                    if(!empty($orders)){
                ?>
                <caption>Orders & Shipping Details</caption>
                <table class="table table-bordered">
                    <tr>
                        <th width="50">SL</th>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Address</th>
                        <th class="text-center">Items</th>
                        <th class="text-right">Total</th>
                        <th>Status</th>
                        <th width="120" class="none text-right">Action</th>
                    </tr>
                    <?php
                        $total_item = $total_amount = 0;
                        foreach ($orders as $key => $row) {
                            $amount       = ($row->amount + $row->shipping_cost);
                            $total_amount += $amount;
                            $total_item   += $row->items;
                    ?>
                    <tr>
                        <td><?=(++$key)?></td>
                        <td>#<?=($row->code)?></td>
                        <td><?=($row->date)?></td>
                        <td><?=($row->name)?></td>
                        <td><?=($row->mobile)?></td>
                        <td><?=($row->address)?></td>
                        <td class="text-center"><?=($row->items)?></td>
                        <td class="text-right">৳<?=number_format($amount, 2)?></td>
                        <td><?=ucfirst($row->status)?></td>
                        <td class="text-right">
                            <?php if($action_menus){
                                foreach($action_menus as $action_menu){
                                if($user_data['privilege']=='president' xor (!empty($aside_action_menu_array) && in_array($action_menu->id,$aside_action_menu_array) && $user_data['privilege']!=='president')){
                                if(strtolower($action_menu->name) == "delete" ){?>
                                    <a class="btn btn-<?php echo $action_menu->type;?>" onclick="return confirm('Are your sure to proccess this action ?')"  href="<?php echo get_url($action_menu->controller_path."/".$row->id); ?>"><i class="<?php echo $action_menu->icon;?>" aria-hidden="true"></i></a>
                                <?php }else{ ?>
                                    <a class="btn btn-<?php echo $action_menu->type;?>"  href="<?php echo get_url($action_menu->controller_path."/".$row->id) ;?>"><i class="<?php echo $action_menu->icon;?>" aria-hidden="true"></i></a>
                            <?php }}}} ?>
                        </td>
                    </tr>
                    <?php }; ?>
                    <tr>
                        <td colspan="6" class="text-right">Total</td>
                        <td class="text-center"><?=($total_item)?></td>
                        <td class="text-right">৳<?=number_format($total_amount, 2)?></td>
                        <td colspan="2"></td>
                    </tr>
                </table>
                <?php }?>
            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>

<script>
    (()=>{
        var status_btn = readAll('.order_status');
        var top_status = read('#top_status');
        var order_id   = "<?=($order->id)?>";
        var status     = "<?=($order->status)?>";
        if(status_btn){
        Object.values(status_btn).forEach(item=>{
            if(status==(item.dataset.status)){
              top_status.innerHTML = (item.dataset.status).replaceAll('_', ' ');
              item.classList.add('btn-primary');
            }
        });
        // Set And process Order Status
        Object.values(status_btn).forEach(btn=>{
            btn.addEventListener('click', event=>{
                Object.values(status_btn).forEach(item=>{
                    item.innerHTML = (item.dataset.status).replaceAll('_', ' ');
                });
                if(btn.dataset.status){
                    btn.innerHTML = `${(btn.dataset.status).replaceAll('_', ' ')}&nbsp;<i class="fa fa-refresh fa-spin"></i>`;
                    axios.post(url+"Ajax/orderStatus", makeFormData({status:(btn.dataset.status), order_id:order_id}))
                    .then(response=>{
                        setTimeout(()=>{
                        if(response.data==1) {
                            btn.innerHTML = (btn.dataset.status).replaceAll('_', ' ');
                            Object.values(status_btn).forEach(item=>{
                                item.classList.remove('btn-primary');
                            });
                            btn.classList.add('btn-primary');
                            top_status.innerHTML = (btn.dataset.status).replaceAll('_', ' ');
                            toastr.success('Order Status Updated');
                            }
                        }, 500);
                    })
                    .catch(err=>console.log(err));
                }
            });
        });}
    })()
</script>
