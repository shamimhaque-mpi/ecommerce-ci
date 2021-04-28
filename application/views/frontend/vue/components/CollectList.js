export default {
	name  : 'Collection',
    props : ['is_login', 'url'],
	template : `
		<ul class="collect_list">
            <li class="android">
                <a href="#"><i class="icon ion-logo-android"></i></a>
            </li>
            <li class="cartBtn">
                <a href="javascript:void(0)"><i class="icon ion-ios-cart"></i></a>
                <span>{{cart}}</span>
            </li>
            <li>
                <a href="javascript:void(0)"><i class="icon ion-md-heart"></i></a>
                <span>12</span>
            </li>
        </ul>
	`,
	mounted(){
		this.$store.state.isLogin = this.is_login;
        this.$store.state.url     = this.url;
        this.readCart();
	},
    methods:{
        readCart:function(){
            axios.post(this.url+'Frontend/Api/cartItems')
            .then(response=>{
                console.log(response.data);
                this.$store.state.cart = response.data;
            })
            .catch(err=>console.log(err));
        }
    },
    computed:{
        cart:function(){
            return Object.values(this.$store.state.cart).length;
        }
    }
}