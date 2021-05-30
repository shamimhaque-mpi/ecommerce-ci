export default {
	name 	 : 'AddToCart',
	template : `<a href="#" @click.prevent="add()" :class="activity_check"><i class="icon ion-md-heart-empty"></i></a>`,
	props    : ['product_id'],
	data(){
		return {
			url : '',
		}
	},
	mounted(){
		this.url = this.$store.state.url;
	},
	methods:{
		add:function(){
			if(this.$store.state.isLogin==1){
				axios.post(this.url+'Frontend/Api/setWishList/'+this.product_id)
				.then(response=>{
					this.$store.state.wishList = response.data;
					toastr.success('Successfully Add To Wishlist');
				})
				.catch(err=>console.log(err));
				}
			else {
				window.location.href=this.url+'login';
			}
		}
	},
	computed:{
		activity_check:function(){
			var items = (this.$store.state.wishList).map(x=>+x);
			if(items.indexOf(+this.product_id)>-1){
				return 'active';
			}
			else return '';
		}
	}
	
}