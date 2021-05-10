export default {
	name  : 'ViewCart',
    data(){
    	return {
    		url 	: ''
    	}
    },
	template : `
<div class="col-lg-9">
    <div class="row">
        <div class="col-lg-8">
            <div class="product_menu" v-for="(item, index) in items">
                <img :src="url+item.image" alt="">
                <div class="product_title">
                    <h6><a :href="details(item.product_id, item.title)">{{item.title}}</a></h6>
                    <p>৳{{price(item.price, item.discount)}}</p>

                    <p v-if="item.size">Size: {{item.size}}</p>
                    <p v-if="item.color">Color: {{item.color}}</p>

                    <a :href="details(item.product_id, item.title)" v-if="item.is_color==1 && !item.color" class="warnig">Color is available, Please Select One</a>
                    <a :href="details(item.product_id, item.title)" v-if="item.is_size==1 && !item.size" class="warnig">Size is available, Please Select One</a>
                </div>
                <div class="product_sum">
                    <div class="action">
                        <div class="qty_form">
                            <button @click.prevent="nimus(item.code)"><i class="icon ion-md-remove" ></i></button>
                            <input type="text" :value="+item.quantity" readonly>
                            <button @click.prevent="plus(item.code)"><i class="icon ion-md-add"></i></button>
                        </div>
                        <a href="#" class="delete" @click.prevent="remove(item.code)">
                            <i class="icon ion-md-trash"></i>
                        </a>
                    </div>
                    <h6 class="total">Total = {{total(index)}} Tk</h6>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="payment_box">
                <table class="table payment_table">
                    <tbody>
                        <tr>
                            <th>Subtotal</th>
                            <td>৳{{subtotal}}</td>
                        </tr>
                        <tr>
                            <th>Taxes</th>
                            <td>৳0</td>
                        </tr>
                        <tr style="border-top: 1px solid #eee;">
                            <th>Total</th>
                            <td>৳{{grandTotal}}</td>
                        </tr>
                    </tbody>
                </table>
                <a :href="url+'checkout'" @click.prevent="checkout()" class="checkout_btn">Proceed to Checkout</a>
            </div>
            <div class="services_div">
                <p><i class="icon ion-md-done-all"></i> Security Policy (Edit With Customer Reassurance Module)</p>
            </div>
            <div class="services_div">
                <p><i class="icon ion-md-car"></i> Security Policy (Edit With Customer Reassurance Module)</p>
            </div>
            <div class="services_div">
                <p><i class="icon ion-md-return-right"></i> Security Policy (Edit With Customer Reassurance Module)</p>
            </div>
        </div>
    </div>
</div>
	`,
	mounted(){
		this.url   = this.$store.state.url;
	},
    methods:{
		remove:function(code){
			this.manageCart('Frontend/Api/removeCartItem', {code:code});
		},
		price:function(price, discount=0){
			return (price - ((price/100)*discount));
		},
		total:function(index){
			var item = this.$store.state.cart[index];
			return parseFloat((item.price - ((item.price/100)*item.discount)) * item.quantity).toFixed(2);
		},
		plus:function(code){
			var data = {
				code 	 : code,
				quantity : +this.$store.state.cart[code].quantity + 1,
			};
			this.manageCart('Frontend/Api/updateCartQuantity', data);
		},
		nimus:function(code){
			var data = {
				code 	 : code,
				quantity : this.$store.state.cart[code].quantity - 1,
			};
			this.manageCart('Frontend/Api/updateCartQuantity', data);
		},
		manageCart:function(url, data){
			axios.post(this.url+url, makeFormData(data))
			.then(response=>{ if(response.data){
				this.$store.state.cart = response.data;
			}})
			.catch(err=>console.log(err));
		},
		details:function(id, title)
		{
			return (this.url+'products/'+btoa(id)+"/"+(title.replaceAll(' ', '-')));
		},
        checkout:function(){
            if(this.$store.state.isLogin==1)
                window.location.href=this.url+'checkout';
            else 
                window.location.href=this.url+'login';
        }
    },
    computed:{
        items:function(){
        	return this.$store.state.cart;
        },
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
		}
	}
}
