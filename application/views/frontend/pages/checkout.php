<!-- include css -->
<link rel="stylesheet" href="<?=site_url('public/style/checkout.css')?>">

<!-- checkout section start -->
<section class="checkout_section">
    <div class="container">
        <form action="" method="post">
            <div class="row">
                <div class="col-md-8">
                    <div class="checkout_form">
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="form-label">Full Name</label>
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Email</label>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Phone Number</label>
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">District Name</label>
                                <div class="form-group">
                                    <select class="form-control" name="">
                                        <option value="">Mymensingh</option>
                                        <option value="">Dhaka</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <label class="form-label">Address</label>
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="product_list">
                        <img src="images/product/item-1.jpg" class="img-fluid" alt="">
                        <div class="product_title">
                            <h6>Product Name Or Title</h6>
                            <p>720 Tk</p>
                            <a href="" class="delete">
                                <i class="icon ion-md-trash"></i>
                            </a>
                            <div class="product_sum">
                                <div class="qty">
                                    <h6>Qty</h6>
                                    <input type="number" class="form-control" value="1" min="0">
                                </div>
                                <h6>Total = 22.71 Tk</h6>
                            </div>
                        </div>
                    </div>
                    <div class="product_list">
                        <img src="images/product/item-1.jpg" class="img-fluid" alt="">
                        <div class="product_title">
                            <h6>Product Name Or Title</h6>
                            <p>720 Tk</p>
                            <a href="" class="delete">
                                <i class="icon ion-md-trash"></i>
                            </a>
                            <div class="product_sum">
                                <div class="qty">
                                    <h6>Qty</h6>
                                    <input type="number" class="form-control" value="1" min="0">
                                </div>
                                <h6>Total = 22.71 Tk</h6>
                            </div>
                        </div>
                    </div>

                    <div class="subtotal_box">
                        <table class="table subtotal_table">
                            <tbody>
                                <tr>
                                    <th>Subtotal</th>
                                    <td>$89.57</td>
                                </tr>
                                <tr>
                                    <th>Shipping</th>
                                    <td>$7.00</td>
                                </tr>
                                <tr>
                                    <th>Taxes</th>
                                    <td>$0.00</td>
                                </tr>
                                <tr style="border-top: 1px solid #eee;">
                                    <th>Total</th>
                                    <td>$90.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn checkout_btn">Confirm</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- checkout section end -->
