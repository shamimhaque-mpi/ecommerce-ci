
window.makeFormData=(object)=>{
    var formdata = new FormData();
    if(typeof object == 'object'){
        for(const key in object){
            if(typeof object[key] == 'object'){
                formdata.append(key, JSON.stringify(object[key]));                
            }else{
                formdata.append(key, object[key]);                
            }
        }
    }
    return formdata;
}

import Vue    from "./module/vue.js";
import store  from "./store.js";

// Modules
import CollectList    from './components/CollectList.js';
import AddToCart      from './components/AddToCart.js';
import AddToWshList   from './components/AddToWshList.js';
import ShoppingCart   from './components/ShoppingCart.js';
import ViewCart       from './components/ViewCart.js';
import Checkout       from './components/Checkout.js';
import ProductDetails from './components/ProductDetails.js';
import ForgotPassword from './components/ForgotPassword.js';

// Components Registration
Vue.component('collect-list', CollectList);
Vue.component('add-to-cart', AddToCart);
Vue.component('add-to-wish-list', AddToWshList);
Vue.component('shopping-cart', ShoppingCart);
Vue.component('view-cart', ViewCart);
Vue.component('checkout', Checkout);
Vue.component('product-details', ProductDetails);
Vue.component('forgot-password', ForgotPassword);

const app = new Vue({
    el: '#app',
    store : store
});


(()=>{
    var _d = (x)=>document.querySelector(x);
        var btn = _d('.category_nav .category_head a');
        if(btn){
            btn.onclick = (event)=>{
                var wrapper = _d('.category_nav .category_list');
                if(wrapper.classList.contains('active')){
                    wrapper.classList.remove('active');
                    _d('.category_nav .category_head a').classList.remove('active')
                }
                else{
                    wrapper.classList.add('active');
                    _d('.category_nav .category_head a').classList.add('active')
                }
            }
        }

        /* purchase card */
        // cartBtn
        // purchase_cart.active
        var cart_btn        = _d('.cartBtn a');
        var purchase_cart   = _d('.purchase_cart')
        var close_bar       = _d('.close_bar')
        if(cart_btn && close_bar){
            cart_btn.onclick =()=>{
                if(purchase_cart.classList.contains('active')){
                    purchase_cart.classList.remove('active');
                }
                else{
                    purchase_cart.classList.add('active');
                }
            }
            close_bar.onclick =()=>{
                purchase_cart.classList.remove('active');
            }
        }

        // Action and Execute when Focus in the window
        window.onclick = (event)=>{
            if(!event.target.closest('.category_nav')){
                _d('.category_nav .category_list').classList.remove('active');
                _d('.category_nav .category_head a').classList.remove('active')
            }
            if(!event.target.closest('.purchase_cart') && !event.target.closest('.cartBtn')){
                    purchase_cart.classList.remove('active');
            }
        }

        /* fixed nav bar in jquery */
        $(window).scroll(function() {
            if($(this).scrollTop() > 75) {
                $('.top_nav .top_content').addClass('active');
                $('.purchase_cart').addClass('scroll_height');
            } else {
                $('.top_nav .top_content').removeClass('active');
                $('.purchase_cart').removeClass('scroll_height');
            };
        });

})()