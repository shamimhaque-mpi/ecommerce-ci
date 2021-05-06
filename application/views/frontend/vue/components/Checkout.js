export default {
	name 	 : 'Checkout',
	template : `
<div class="container">
    <div class="notice_board" v-if="isWarning">
        <h4 class="notic">Warning</h4>
        <p>There are some products, which you should choose color and size</p>
    </div>
    <form action="" @submit.prevent="submit()">
        <div class="row">
            <div class="col-md-8">
                <div class="checkout_form">
                    <div class="row">

                        <div class="col-sm-6">
                            <label class="form-label">Full Name<strong>*</strong></label>
                            <div class="form-group">
                                <input type="text"" v-model="name" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label">Phone Number<strong>*</strong></label>
                            <div class="form-group">
                                <input type="text" v-model="mobile" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label">District Name<strong>*</strong></label>
                            <div class="form-group">
                                <select class="form-control selectpicker" id="districts" v-model="district_id" data-live-search="true" @change="getUpazila(district_id)" required>
                                    <option v-for="district in districts" :value="district.id">{{district.name}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label">Upazilla<strong>*</strong>&nbsp;<i :class="loader"></i></label>
                            <div class="form-group">
                                <select class="form-control selectpicker" id="upazillas" v-model="upazilla_id" data-live-search="true" @change="getShippingSearge(upazilla_id)" required>
                                    <option v-for="upazilla in upazillas" :value="upazilla.id">{{upazilla.name}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <label class="form-label">Shipping Address<strong>*</strong></label>
                            <div class="form-group">
                                <textarea class="form-control" id="co_address" v-model="shipping_address" name="w3review" rows="3" required></textarea>
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
                                <td>৳{{parseFloat(subtotal).toFixed(2)}}</td>
                            </tr>
                            <tr>
                                <th>Taxes</th>
                                <td>৳0.00</td>
                            </tr>
                            <tr>
                                <th>Shipping</th>
                                <td>৳{{parseFloat(shipping_cost).toFixed(2)}}</td>
                            </tr>
                            <tr style="border-top: 1px solid #eee;">
                                <th>Grand Total</th>
                                <td>৳{{parseFloat(+grandTotal+ +shipping_cost).toFixed(2)}}</td>
                            </tr>
                            <tr>
                                <th style="padding-top: 15px;">Trx Method<strong>*</strong></th>
                                <td style="padding-top: 15px;">
                                    <select class="form-control selectpicker" v-model="method_id" @change="trxInfo(method_id)" data-live-search="true" id="payment_methods" required>
                                        <option v-for="method in payment_methods" :value="method.id">{{method.method}}</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">{{trx_info}}</td>
                            <tr>
                            <tr v-if="trx_info">
                                <th>Trx No<strong>*</strong></th>
                                <td><input type="text" class="form-control" v-model="trx_no" required></td>
                            </tr>
                            <tr v-if="trx_info">
                                <th>Trx ID<strong>*</strong></th>
                                <td><input type="text" class="form-control" v-model="trx_code" required></td>
                            </tr>
                            <tr v-if="trx_info">
                                <th>Trx Amount<strong>*</strong></th>
                                <td><input type="text" class="form-control" v-model="trx_amount" required></td>
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
    <div class="loading" v-if="msg">
        <span v-if="msg=='loading'"><i class="fa fa-spinner fa-pulse"></i></span>
        <span v-if="msg=='success'" >Submit successful, wait for confarmation. . .</span>
    </div>
</div>
	`,
    props:['user_id','user_name','user_mobile','user_address'],
	data() {
		return {
			url 	         : '',
			methods          : [],
            shipping_cost    : 0,

            districts   : [],
            district_id : '',
            upazillas    : [],
            upazilla_id  : '',

            name             : '',
            mobile           : '',
            shipping_address : '', 
            payment_methods  : [],
            method_id        : '',
            trx_info         : '',
            trx_no           : '',
            trx_code         : '',
            trx_amount       : 0, 
            loader           : '',
            msg              : '',
		}
	},
	mounted(){
		this.url                = this.$store.state.url;
        this.name               = this.user_name;
        this.mobile             = this.user_mobile;
        this.shipping_address   = this.user_address;

        $(".selectpicker").selectpicker();

        axios.post(this.url+'/Frontend/Api/getDistricts')
        .then(response=>{
            this.districts = response.data;
            setTimeout(()=>{
                $("#districts").selectpicker('refresh');
            },10);
        });

        axios.post(this.url+'/Frontend/Api/getPaymentMethod')
        .then(response=>{
            this.payment_methods = response.data;
            setTimeout(()=>{
                $("#payment_methods").selectpicker('refresh');
            },10);
        });   
	},
	methods:{
		getUpazila:function(district_id){
            this.loader = 'fa fa-spinner fa-pulse';
            var data = {
                where : {
                    district_id:district_id
                }
            };
            axios.post(this.url+'/Frontend/Api/getUpazillas', makeFormData(data))
            .then(response=>{
                this.upazillas = response.data;
                console.log(this.upazillas);
                setTimeout(()=>{
                    $("#upazillas").selectpicker('refresh');
                    this.loader = '';
                },10);
            })
            .catch(err=>console.log(err));
        },
        getShippingSearge:function(upazilla_id){
            this.shipping_cost = 0;
            var Vobj = this; 
            Object.values(this.upazillas).forEach((item)=>{
                if(item.id==upazilla_id){
                    Vobj.shipping_cost = item.shipping_cost;
                }
            });
        }, 
        trxInfo:function(id){
            var Vobj = this;
            this.trx_info = '';
            Object.values(this.payment_methods).forEach((item)=>{
                if(item.id==id && item.number){
                    Vobj.trx_info = `${item.number} (${item.type})`;
                }
            });
        },
        submit:function(){
            if(Object.values(this.$store.state.cart).length>0){

                var trx_method = "";
                Object.values(this.payment_methods).forEach((method)=>{
                    if(method.id==this.method_id){
                        trx_method = method.method;
                    }
                });

                this.msg ='loading';
                var data = {
                    user_id : this.user_id,
                    name    : this.name,
                    mobile  : this.mobile,
                    address : this.shipping_address,

                    district_id     : this.district_id,
                    upazilla_id     : this.upazilla_id,
                    shipping_cost   : this.shipping_cost,

                    method_id   : this.method_id,
                    trx_method  : trx_method,
                    trx_no      : this.trx_no,
                    trx_code    : this.trx_code,
                    trx_amount  : this.trx_amount
                };
                axios.post(this.url+'Frontend/Api/checkout', makeFormData(data))
                .then(response=>{
                    if(response.data==0){
                        alert("Something Is Wrong!!");
                    }else{
                        this.msg ='success';
                        window.location.href=this.url="user-panel/order_view/"+response.data;
                    }
                })
                .catch(err=>console.log(err));
            }
        }
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