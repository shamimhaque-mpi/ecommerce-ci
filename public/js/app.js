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
