export default {
	name 	 : 'Checkout',
	template : `
<div class="container">
        <div class="notice_board" v-if="isWarning">
            <h4 class="notic">Warning</h4>
            <p>There are some products, which you should choose color and size</p>
        </div>
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
                            <div class="col-sm-6">
                                <label class="form-label">Upazila</label>
                                <div class="form-group">
                                    <select class="form-control" name="">
                                        <option value="">Mymensingh</option>
                                        <option value="">Dhaka</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <label class="form-label">Shipping Address</label>
                                <div class="form-group">
                                    <textarea class="form-control" id="co_address" name="w3review" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="subtotal_box">
                        <table class="table subtotal_table">
                            <tbody>
                                <tr>
                                    <th>Subtotal</th>
                                    <td>৳{{subtotal}}</td>
                                </tr>
                                <tr>
                                    <th>Taxes</th>
                                    <td>৳0.00</td>
                                </tr>
                                <tr>
                                    <th>Shipping</th>
                                    <td>৳0.00</td>
                                </tr>
                                <tr style="border-top: 1px solid #eee;">
                                    <th>Grand Total</th>
                                    <td>৳{{grandTotal}}</td>
                                </tr>
                                <tr>
                                    <th style="padding-top: 15px;">Trx Method</th>
                                    <td style="padding-top: 15px;">
                                        <select class="form-control">
                                            <option value="">Select Method</option>
                                            <option value="bikash">Bkash</option>
                                            <option value="rocket">Roket</option>
                                            <option value="nagot">Nagot</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Trx No</th>
                                    <td><input type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <th>Trx Code</th>
                                    <td><input type="text" class="form-control"></td>
                                </tr>

                            </tbody>
                        </table>
                        <div class="checkout_btn">
                            <button type="submit" class="btn">Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

	`,
	data() {
		return {
			url 	: '',
			methods : [],
		}
	},
	mounted(){
		this.url = this.$store.state.url;
		axios.post()
		.then()
	},
	methods:{
		
		
	},
	computed:{
		totalItem:function(){
			return Object.values(this.$store.state.cart).length;
		},
		subtotal:function(){
			var subtotal = 0;
			Object.values(this.$store.state.cart).forEach(item=>{
				var less = (item.price/100)*item.discount;
				subtotal += ((item.price-less) * item.quantity);
			});
			return parseFloat(subtotal).toFixed(2);
		},
		grandTotal:function(){
			var subtotal = 0;
			Object.values(this.$store.state.cart).forEach(item=>{
				var less = (item.price/100)*item.discount;
				subtotal += ((item.price-less) * item.quantity);
			});
			return parseFloat(subtotal).toFixed(2);
		},
		isWarning:function(){
			var is = false;
			Object.values(this.$store.state.cart).forEach(item=>{
				if(item.is_color==1 && !item.color)
					is = true;
				if(item.is_size==1 && !item.size)
					is = true;
			});
			return is;
		}
	}
	
}