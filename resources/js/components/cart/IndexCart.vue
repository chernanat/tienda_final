<template>
    <section class="container">
        <div>
            <form v-on:submit.prevent="update()">
            <table class="table mt-5">
                <thead>
                    <tr>
                        <th></th>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <td scope="col">Subtotal</td>
                        <td scope="col"></td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item,index) in items" :key="index">   
                        <th>                
                            <img :src="item.product.photo" alt="Card image cap" style="width: 3rem;">
                        </th>
                        <th>{{item.product.name}}</th>
                        <th>$ {{item.product.price}}</th>
                        <input class="form-control" type="hidden" :value="Number(item.quantity)">
                        <th><input class="form-control" type="number" v-model="item.quantity"></th>
                        <th>$ {{item.quantity*item.product.price}}</th>
                        <th><input @click="del(item.id)" class="btn btn-danger" type="button" value="Delete"></th>
                    </tr>
                </tbody>
            </table>
                <div class="d-grid gap-2 text-center">
                    <input @click="update()" class="btn btn-lg btn-success" type="button" value="Update Cart">
                </div>
            </form>
            <h3>Total Checkout</h3>
            <ul v-for="(item,index) in items" :key="index" class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Product Name: 
                    <span>{{item.product.name}}</span>
                    <!-- <span class="badge bg-primary rounded-pill">14</span> -->
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Quantity:
                    <span>{{item.quantity}}</span>
                </li>
            </ul>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Total:
                    <span class="badge bg-primary rounded-pill">{{total}}</span>
                </li>
            <div class="d-grid gap-2 text-center">
                <input class="btn btn-lg btn-success" type="button" value="CHECKOUT!">
            </div>
        </div>
    </section>
</template>

<script>
import Swal from 'sweetalert2'
import Auth from '../helpers/auth'
export default {
    props:{

    },
    data(){
        return{
            user:'',
            items:[],
            total: 0,
        }
    },
    created(){
    },
    mounted(){
        Auth.initialize()
        this.user = Auth.data
        this.getitems()
    },
    methods:{
        getitems(){
            // console.log(this.user.id);
            if(this.user.id == null){
                Swal.fire('You Need To Be Logged First!', '', 'warning')
                window.location.href = "/home"
            }
            else{
                axios.post('/cart/items',this.user).then(res=>{
                   this.items = res.data
                    // console.log(res.data); 
                    this.suma()
                }).catch(err=>{
                    console.log(err);
                })
            }
        },
        suma(){
            this.total = 0
            for(let i=0;i<this.items.length;i++){
                this.total = this.total + this.items[i].price*this.items[i].quantity
            }
        },
        del(id){
            axios.get(`/cart/delete/${id}`).then(res=>{
                if(res.data.deleted){
                    Swal.fire('Item Removed!', '', 'info')
                    this.getitems()
                }
            }).catch(err=>{
                console.log(err);
            })
        },
        update(){
            axios.post(`/cart/update`,this.items).then(res=>{
                if(res.data.updated){
                    Swal.fire('Item Updated!', '', 'success')
                    this.getitems()
                }
            }).catch(err=>{
                console.log(err);
            })
        }
    }

}
</script>