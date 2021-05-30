export default {
	name 	 : 'ProductDetails',
	props    : ['product_id'],
	template : `
	<div>

		<div class="rating_box">
			<h6>Rating :</h6>
			<ul class="rating_list" ref="ratings">
				<li title="Poor" @click="setRating(1)"><i class="icon ion-md-star"></i></li>
				<li title="Fair" @click="setRating(2)"><i class="icon ion-md-star"></i></li>
				<li title="Good" @click="setRating(3)"><i class="icon ion-md-star"></i></li>
				<li title="Excellent" @click="setRating(4)"><i class="icon ion-md-star"></i></li>
				<li title="WOW!!!" @click="setRating(5)"><i class="icon ion-md-star"></i></li>
			</ul>
		</div>

	    <div class="size_box" v-if="sizes.length>0">
	        <h6>Size :</h6>
	        <ul class="size_list">
	            <li class="size" v-for="item in sizes" v-if="item.id">
	                <input type="radio" id="s" :value="item.id" v-model="size_id" @click="setSize(item.id)" name="size">
	                <label for="s">{{item.size}}</label>
	            </li>
	        </ul>
	    </div>

	    <div class="color_box" v-if="colors.length>0">
	        <h6>Color :</h6>
	        <div class="color_box_">
				<div class="color_" v-for="item in colors" v-if="item.id">
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
	props    : ['product_id', 'available_quantity', 'user_id'],
	data() {
		return {
			url 		 : '',
			code 		 : '',
			is_available : false,
			colors 		 : [],
			sizes 		 : [],
			color_id	 : '',
			size_id	 	 : '',
			ratings_tabs : [],
			product_rate : null,
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
		// Rating
		this.ratings_tabs = this.$refs.ratings.children;
		this.ratingHover();
		this.rateInitialization();

		if(this.user_id){
			axios.post(this.url+'Frontend/Api/getProductRate/', makeFormData({user_id:this.user_id, product_id:this.product_id}))
			.then(response=>{this.product_rate=response.data;})
			.catch(err=>console.log(err));
		}

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
			})
			.catch(err=>console.log(err));
		},
		addToWish:function(product_id){
			if(this.$store.state.isLogin==1){
				axios.post(this.url+'Frontend/Api/setWishList/'+product_id)
				.then(response=>{
					this.$store.state.wishList = response.data;
					toastr.success('Successfully Add To Wishlist');
				})
				.catch(err=>console.log(err));
			}
			else{window.location.href=this.url+'login';}
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
		},
		ratingHover:function(){
			Object.values(this.ratings_tabs).forEach((tab, key)=>{
				tab.addEventListener('mouseover', ()=>{
					Object.values(this.ratings_tabs).forEach((tabDublicate, key2)=>{
						if(key>=key2){
							tabDublicate.classList.add('active');							
						}
						else{
							tabDublicate.classList.remove('active');							
						}
					});			
				});

				tab.addEventListener('mouseout', ()=>{
					this.rateInitialization();
				});

			});
		},
		setRating:function(rate){

			if(this.$store.state.isLogin){

				var data = {
					product_id : this.product_id, 
					user_id    : this.user_id,
					rate       : rate
				};

				this.product_rate = rate;
				axios.post(this.url+'Frontend/Api/setProductRating', makeFormData(data))
				.then(response=>{
					if(response.data==1){
						toastr.success('Thank You For Rate This Product');
					}
				})
				.catch(err=>console.log(err));

			}
			else{window.location.href=this.url+'login';}
		},
		rateInitialization:function() {
			Object.values(this.ratings_tabs).forEach((tabDublicate, key)=>{
				if((this.product_rate-1)>=key){
					tabDublicate.classList.add('active');							
				}
				else{
					tabDublicate.classList.remove('active');							
				}
			});		
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
	},
	watch:{
		product_rate:function(){
			this.rateInitialization();
		}
	}

}
