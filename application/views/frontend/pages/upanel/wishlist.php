<!-- include css -->
<link rel="stylesheet" href="<?=site_url('public/style/user.css')?>">

<!-- dashboard section start -->
<section class="user_section pt-4">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="user_aside">
                    <h3><?=(user()->name)?></h3>
                    <ul class="user_menu">
                        <li><a href="<?=site_url('user-panel/dashboard')?>" class="nav-link">Dashboard</a></li>
                        <li><a href="<?=site_url('user-panel/order')?>" class="nav-link">Order</a></li>
                        <li><a href="" class="nav-link active">Wishlist</a></li>
                        <li><a href="<?=site_url('user-panel/profile')?>" class="nav-link">Profile</a></li>
                    </ul>
                    <a href="<?=site_url('logout')?>" class="btn logout_btn">Logout</a>
                </div>
            </div>
            <div class="col-md-8">
                <div class="user_content">
                    <h5 class="user_title">Wish-List</h5>
                    <div class="table-responsive">
                        <?php if(!empty($wishlist)){ ?>
                        <table class="table">
                            <tr>
                                <th>Sl</th>
                                <th></th>
                                <th>Product name</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th class="text-right">Action</th>
                            </tr>
                            <?php foreach($wishlist as $key=>$row){ ?>
                            <tr>
                                <td><?=(++$key)?></td>
                                <td><img src="<?=site_url($row->feature_photo)?>" alt=""></td>
                                <td>
                                    <a class="list_title" href="<?=site_url("products/".base64_encode($row->id)."/".(str_replace(' ', '-', $row->title)))?>"><?=($row->title)?></a>
                                </td>
                                <td>৳<?=($row->sale_price ? $row->sale_price : 0)?></td>
                                <td><span class="stock"><?=($row->quantity > 0 ? "In Stock":"Out In Stock")?></span></td>
                                <td class="text-right">
                                    <a href="<?=site_url('Frontend/Upanel/UpanelController/removeFromwishlist/'.$row->id)?>" onclick="return confirm('Are You Sure??')" class="order-btn product_cancle">Delete</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </table>
                        <?php } else{ ?>
                            <div class="not_found">
                                <div class="found_content">
                                    <img src="<?=site_url('private/images/not_found.png')?>" alt="">
                                    <h5>Products Not Found, <a href="<?=site_url('')?>">Back To Shop</a></h5>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- dashboard section end -->
