<template>
    <section class="container">
        <!-- {{product}} -->
    <form v-for="(category,index) in categories" :key="index">
        <h3 class="mt-5">{{category.name}}</h3>
        <div class="row"  v-if="product">
            <div v-for="(prod,index) in product" :key="index" class="col-md card" style="width: 18rem;">
                <img v-if="category.id == prod.category.id" :src="prod.photo" alt="Card image cap">
                <div v-if="category.id == prod.category.id" class="card-body">
                    <h4 class="card-title"></h4>
                    <h6 class="card-subtitle mb-2">{{prod.name}}</h6>
                    <p class="card-text"><b>Description:    </b>{{prod.description}}.</p>
                    <p class="card-text"><b>Price: $</b>{{prod.price}}</p>
                    <input class="card-text" v-model="cart.price" type="hidden">
                    <input v-model="prod.id" type="hidden">
                    <!-- <div class="card text-center">
                        <label class="form-label">Quantity:</label>
                        <input class="form-control" type="number">
                    </div> -->
                    <div class="text-center">
                        <input @click="add_cart(prod.id)" type="button" value="Add Cart" class="btn btn-success mt-2">
                    </div>
                </div>
            </div>
        </div>
    </form>
    </section>
</template>

<script>
import Auth from './helpers/auth'
export default {
    props: ['product','categories'],
    data(){
        return{
            cart:{
                product_id:'',
                user_id:''
            },
        }
    },
    created(){

    },
    mounted(){
        Auth.initialize()
        this.cart.user_id = Auth.data.id
    },
    methods:{
        add_cart(id){
            this.cart.product_id = id
            if(this.cart.user_id == null){
                Swal.fire('You Need To Be Logged First!', '', 'warning')
            }
            else{
                axios.post('/cart/save',this.cart).then(res=>{
                    if(res.data.Saved){
                        Swal.fire('Item Added To Cart!','','success')
                    }
                    // console.log(res.data);
                }).catch(err=>{
                    console.log(err);
                })
            }
        }
    }
}
</script>
