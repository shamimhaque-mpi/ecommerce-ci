export default {
	name  : 'ShoppingCart',
	template : `
		<div class="purchase_cart" >
		    <div class="title">
		        <span><i class="icon ion-ios-basket"></i>{{totalItem}} Products added</span>
		        <a href="javascript:void(0)" class="close_bar">
		            <i class="icon ion-ios-close"></i>
		        </a>
		    </div>

		    <div class="purchase_body">
		        <div class="order_items" v-for="item in cart">
		            <div class="quantity">
		                <a href="#" @click.prevent="plus(item.code)"><i class="icon ion-md-add"></i></a>
		                <span>{{+item.quantity}}</span>
		                <a href="#" @click.prevent="nimus(item.code)"><i class="icon ion-md-remove"></i></a>
		            </div>
		            <img :src="url+item.image" alt="">
		            <div class="name_title">
		                <h5>{{item.title}}</h5>
		                <p>{{item.price}} Tk</p>
		            </div>
		            <button class="purchase_close" @click.prevent="remove(item.code)">
		                <i class="icon ion-ios-close"></i>
		            </button>
		        </div>
		    </div>

		    <div class="purchase_footer">
		        <div class="subtotal">
		            <h5>Subtotal</h5>
		            <span>৳ {{subtotal}}</span>
		        </div>
		        <div class="order">
		            <a :href="url+'view_cart'">View cart</a>
		            <a :href="url+'checkout'">Checkout</a>
		        </div>
		    </div>
		</div>
	`,
	data(){
		return {
			url  : '',
			shoppingCart : [],
		}
	},
	mounted(){
		this.url  = this.$store.state.url;
	},
	methods:{
		remove:function(code){
			this.manageCart('Frontend/Api/removeCartItem', {code:code});
		},
		plus:function(code){
			var data = {
				code 	 : code,
				quantity : +this.shoppingCart[code].quantity + 1,
			};
			this.manageCart('Frontend/Api/updateCartQuantity', data);
		},
		nimus:function(code){
			var data = {
				code 	 : code,
				quantity : this.shoppingCart[code].quantity - 1,
			};
			this.manageCart('Frontend/Api/updateCartQuantity', data);
		},
		manageCart:function(url, data){
			axios.post(this.url+url, makeFormData(data))
			.then(response=>{ if(response.data){
				this.$store.state.cart = response.data;
			}})
			.catch(err=>console.log(err));
		}
	},
	computed:{
		cart:function(){
			this.shoppingCart = this.$store.state.cart;
			return this.$store.state.cart;
		},
		totalItem:function(){
			return Object.values(this.$store.state.cart).length;
		},
		subtotal:function(){
			var subtotal = 0;
			Object.values(this.$store.state.cart).forEach(item=>{
				subtotal += (item.price * item.quantity);
			});
			return subtotal;
		}
	}
}