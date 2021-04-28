export default {
	name 	 : 'AddToCart',
	template : `<a href="#" @click.prevent="add()"><i class="icon ion-md-heart-empty"></i></a>`,
	props    : ['product_id'],
	mounted(){},
	methods:{
		add:function(){
			console.log(this.product_id);
		}
	}
	
}