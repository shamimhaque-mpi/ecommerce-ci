export default {
	name 	 : 'AddToCart',
	template : `<a href="#" @click.prevent="add()"><i class="icon ion-ios-cart"></i></a>`,
	props    : ['product_id'],
	data() {
		return {
			url : '',
		}
	},
	mounted(){
		this.url = this.$store.state.url;
	},
	methods:{
		add:function(){
			axios.post(this.url+'Frontend/Api/setCartItem', makeFormData({product_id: this.product_id}))
			.then(response=>{
				this.$store.state.cart = response.data;
			})
			.catch(err=>console.log(err));
		}
	}
	
}