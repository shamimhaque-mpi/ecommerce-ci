export default {
	name  : 'Collection',
    props : ['is_login', 'url', 'apk'],
	template : `
		<ul class="collect_list">
            <li class="android">
                <a :href="url+apk" download><i class="icon ion-logo-android"></i></a>
            </li>
            <li class="cartBtn">
                <a href="javascript:void(0)"><i class="icon ion-ios-cart"></i></a>
                <span>{{cart}}</span>
            </li>
            <li @click="wishList()">
                <a href="javascript:void(0)"><i class="icon ion-md-heart"></i></a>
                <span>{{wishlist}}</span>
            </li>
        </ul>
	`,
	mounted(){
		this.$store.state.isLogin = this.is_login;
        this.$store.state.url     = this.url;
        this.readCart();
        this.readWishList();
	},
    methods:{
        readCart:function(){
            axios.post(this.url+'Frontend/Api/cartItems')
            .then(response=>{
                this.$store.state.cart = response.data;
            })
            .catch(err=>console.log(err));
        },
        readWishList:function(){
            axios.post(this.url+'Frontend/Api/wishList')
            .then(response=>{
                this.$store.state.wishList = response.data;
            })
            .catch(err=>console.log(err));
        },
        wishList:function(){
            window.location.href = this.url+"user-panel/wishlist";
        }
    },
    computed:{
        cart:function(){
            return Object.values(this.$store.state.cart).length;
        },
        wishlist:function(){
            return (this.$store.state.wishList).length;
        }
    }
}