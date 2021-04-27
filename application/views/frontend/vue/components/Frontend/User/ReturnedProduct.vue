<template>
	<div>
        <div class="">
            <div class="card">
                <div class="card-header">
                    <h4>My Returned Product</h4>
                    <!-- <h5>Total Wishlist: <span>{{ getWishedItem.length }}</span></h5> -->
                </div>
                <div class="card-body row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                        	<table class="table table-bordered">
                        		<tr>
                        			<th>SL</th>
                        			<th>Product</th>
                        			<th>Price</th>
                        			<th>QTY</th>
                        			<th>Amount</th>
                        			<th>Status</th>
                        		</tr>
                        		<tr v-for="(product, key) in products">
                        			<td>{{ ++key }}</td>
                        			<td>{{ product.title }}</td>
                        			<td>{{ product.price }}</td>
                        			<td>{{ product.quantity }}</td>
                        			<td>{{ (product.quantity * product.price) }}</td>
                        			<td>Complete</td>
                        		</tr>
                        	</table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
	export default {
		name: 'ReturnedProduct',
		data(){
			return {
				products : [],
			}
		},
		mounted(){
			axios.get(this.$store.state.front_url+'/get-return-products')
            .then((response) => {
                this.products = response.data;
            })
            .catch((exception) => {
                console.log(exception);
            });
		},
	}
</script>