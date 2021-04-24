var read = (x)=>document.querySelector(x);
(()=>{


var not_found = `<h4 class="not_found">Nothing Found !</h4>`;

	var wrapper    = read('#search_suggest');
	var search     = read("input[name='search']");

	if(wrapper && search){
		search.addEventListener('focus', ()=>{
			wrapper.classList.add('open');
			if(search.value==""){
				wrapper.innerHTML = `<h4 class="not_found">Search Your Favorite Product...</h4>`;				
			}
		});

		var timeout = null;
		search.addEventListener('keyup', ()=>{
			if(search.value!=''){
				if(timeout){clearTimeout(timeout);}
				timeout=setTimeout(()=>{
					axios.post(url+"frontend/homecontroller/get_products", makeFormData({key:search.value}))
					.then(response=>{
						console.log((response.data));
						if((response.data).length>0){
							var items = '';
							Object.values(response.data).forEach((item)=>{
								items += rendarItem(item);
							});
							wrapper.innerHTML = items;
						}
						else
						{
							wrapper.innerHTML = `<h4 class="not_found">Noting Found...</h4>`;	
						}
					})
					.catch(err=>console.log(err));
				}, 500);
			}else{
				wrapper.innerHTML = `<h4 class="not_found">Search Your Favorite Product...</h4>`;	
			}
		});
	}

	window.addEventListener('click', (event)=>{
		var target = event.target;
		if(target && wrapper && !target.closest('.search_form')){
			wrapper.classList.remove('open');
		}
	});



	function rendarItem(item){
		var parameter = btoa(JSON.stringify({'product.id':item.id}));
		var text = `
		<a href="${url+'products/'+parameter+'/'+(item.title).replaceAll(' ', '-')}" class="search_product">
		    <img src="${url+item.feature_photo}" alt="">
		    <span class="title">
		        <h5>${item.title}</h5>
		        <p>${item.description}</p>
		    </span>
		    <h6>${(!item.quantity || item.quantity==0)?'Sold Out':''}</h6>
		    <span class="offer">(-${item.discount}% Off)</span>
		    <span class="price">
		        <h5>${(item.sale_price)?item.sale_price+'TK':''}</h5>
		    </span>
		</a>
		`;
		return text;
	}

})()