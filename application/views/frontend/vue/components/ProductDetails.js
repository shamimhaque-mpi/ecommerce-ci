export default {
	name 	 : 'ProductDetails',
	props    : ['product_id'],
	template : `

<div>
    <div class="size_box">
        <h6>Size:</h6>
        <ul class="size_list">
            <li class="size" v-for="item in sizes">
                <input type="radio" id="s" :value="item.id" v-model="size_id" @click="setSize(item.id)" name="size">
                <label for="s">{{item.size}}</label>
            </li>
        </ul>
    </div>

    <div class="color_box">
        <h6>Color:</h6>
        <div class="color_box_">
			<div class="color_" v-for="item in colors">
				<input type="radio" name="color_" v-model="color_id" :value="item.id" @click="setColor(item.id)">
				<div :style="'background:'+item.color_code"></div>
			</div>
		</div>
    </div>

    <div class="quantity" v-if="is_available==true">
        <h6>Quantity</h6>
        <div class="qty_form">
            <button @click.prevent="nimus(code)"><i class="icon ion-md-remove"></i></button>
            <input type="text" id="qty" :value="quantity" min="0" readonly>
            <button @click.prevent="plus(code)"><i class="icon ion-md-add"></i></button>
        </div>
    </div>

    <div class="submit-btn" :class="check">
        <a href="javascript:void(0)" v-if="!available_quantity">Out Of Stock</a>
        <a href="" @click.prevent="addToCart(product_id)" v-if="available_quantity">Add to cart</a>
        <a href="" @click.prevent="addToWish(product_id)">Add To Wish List</a>
    </div>
</div>

	`,
	props    : ['product_id', 'available_quantity'],
	data() {
		return {
			url 		 : '',
			code 		 : '',
			is_available : false,
			colors 		 : {},
			sizes 		 : {},

			color_id	 : '',
			size_id	 	 : '',
		}
	},
	mounted(){
		this.url = this.$store.state.url;
		// Get peoduct colors
		axios.post(this.url+'Frontend/Api/getProductColors/'+this.product_id)
		.then(response=>{this.colors=response.data})
		.catch(err=>console.log(err));

		// Get Product sizes
		axios.post(this.url+'Frontend/Api/getProductSizes/'+this.product_id)
		.then(response=>{this.sizes=response.data;})
		.catch(err=>console.log(err));
	},
	methods:{
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
		addToCart:function(id){
			axios.post(this.url+'Frontend/Api/setCartItem', makeFormData({
				product_id : id,
				color_id   : this.color_id,
				size_id    : this.size_id
			}))
			.then(response=>{
				this.$store.state.cart = response.data;
				this.is_available      = true;
				console.log(response.data);
			})
			.catch(err=>console.log(err));
		},
		addToWish:function(product_id){
			if(this.$store.state.isLogin==1){
				axios.post(this.url+'Frontend/Api/setWishList/'+product_id)
				.then(response=>{
					this.$store.state.wishList = response.data;
				})
				.catch(err=>console.log(err));
				}
			else {
				window.location.href=this.url+'login';
			}
		},
		setSize:function(size_id){
			if(this.is_available){
				axios.post(this.url+'Frontend/Api/setItemSize', makeFormData({code:this.code, size_id:size_id}))
				.then(response=>{
					this.$store.state.cart = response.data;
				})
				.catch(err=>console.log(err));
			}
		},
		setColor:function(color_id){
			if(this.is_available){
				axios.post(this.url+'Frontend/Api/setItemColor', makeFormData({code:this.code, color_id:color_id}))
				.then(response=>{
					this.$store.state.cart = response.data;
				})
				.catch(err=>console.log(err));
			}
		}
	},
	computed:{
		check:function(){
			Object.values(this.$store.state.cart).forEach(item=>{
				if(item.product_id==this.product_id){
					this.is_available = true;
					this.code  		  = item.code;
					this.color_id 	  = item.color_id;
					this.size_id 	  = item.size_id;
					return true;
				}
				else{
					this.is_available = false;
					return false;
				} 	
			});
		},
		quantity:function(){
			if(this.$store.state.cart[this.code]){
				return this.$store.state.cart[this.code].quantity;				
			}
			else {return 0;}
		}
	}
	
}