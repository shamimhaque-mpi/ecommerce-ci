export default {
	name 	 : 'ProductDetails',
	props    : ['product_id'],
	template : `

<div>
    <div class="size_box">
        <h6>Size:</h6>
        <ul class="size_list">
            <li class="size">
                <input type="radio" id="s" name="size" checked>
                <label for="s">S</label>
            </li>
            <li class="size">
                <input type="radio" id="m" name="size">
                <label for="m">M</label>
            </li>
            <li class="size">
                <input type="radio" id="l" name="size">
                <label for="l">L</label>
            </li>
            <li class="size">
                <input type="radio" id="xl" name="size">
                <label for="xl">XL</label>
            </li>
            <li class="size">
                <input type="radio" id="xxl" name="size">
                <label for="xxl">XXL</label>
            </li>
        </ul>
    </div>

    <div class="color_box">
        <h6>Color:</h6>
        <ul class="color_list">
            <li class="black">
                <input type="radio" name="color">
            </li>
            <li class="red">
                <input type="radio" name="color">
            </li>
            <li class="green">
                <input type="radio" name="color">
            </li>
            <li class="blue">
                <input type="radio" name="color">
            </li>
            <li class="maroon">
                <input type="radio" name="color" checked>
            </li>
        </ul>
    </div>

    <div class="quantity" v-if="is_available">
        <h6>Quantity</h6>
        <div class="qty_form">
            <button @click.prevent="nimus(code)"><i class="icon ion-md-remove"></i></button>
            <input type="text" id="qty" :value="quantity" min="0" readonly>
            <button @click.prevent="plus(code)"><i class="icon ion-md-add"></i></button>
        </div>
    </div>

    <div class="submit-btn" :class="check">
        <a href="" @click.prevent="addToCart(product_id)">Add to cart</a>
        <a href="">Buy Now</a>
    </div>
</div>

	`,
	props    : ['product_id'],
	data() {
		return {
			url 		 : '',
			code 		 : '',
			is_available : false,
		}
	},
	mounted(){
		this.url = this.$store.state.url;
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
			axios.post(this.url+'Frontend/Api/setCartItem', makeFormData({product_id: id}))
			.then(response=>{
				this.$store.state.cart = response.data;
				this.is_available      = true;
			})
			.catch(err=>console.log(err));
		}
	},
	computed:{
		check:function(){
			Object.values(this.$store.state.cart).forEach(item=>{
				if(item.product_id==this.product_id){
					this.is_available = true;
					this.code = item.code;
				}
			});
			return "";
		},
		quantity:function(){
			return this.$store.state.cart[this.code].quantity;
		}
	},
	watch:{
		code:function(){
			if(this.code!=""){
				console.log();
			}
		}
	}
	
}