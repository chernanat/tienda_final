<template>
<section>
        <h1 class="text-center">Products</h1>
        <h2>Create Product</h2>
        <form class="form" v-on:submit.prevent="save()">
            <div>
                <label class="form-label" for="">Product Name:</label>
                <input v-model="product.name" class="form-control" type="text">
            </div>
            <div class="form-group">
                <label class="form-label" for="">Category:</label>
                <select v-model="product.category_id" class="form-control">
                    <option v-for="(category,index) in categories" :key="index" :value="category.id">{{category.name}}</option>
                </select>
            </div>
            <div>
                <label class="form-label" for="">Quantity:</label>
                <input v-model="product.quantity" class="form-control" type="number">
            </div>  
            <div>
                <label class="form-label" for="">Image:</label>
                <input class="form-control" type="file" @change="photo">
            </div>  
            <div>
                <label class="form-label" for="">Price:</label>
                <input v-model="product.price" class="form-control" type="number">
            </div>  
            <div>
                <label class="form-label" for="">Description:</label>
                <input v-model="product.description" class="form-control" type="text">
            </div>  
            <br>
            <div class="d-grid gap-2 text-center">
                <input class="btn btn-success" type="submit" value="Create Product">
            </div>         
        </form>
</section>
</template>

<script>
import Auth from '../helpers/auth'
import TableProduct from './TableProduct.vue'

export default {
    components:{    
        TableProduct
    },
    props:[
        'categories'
    ],
    data(){
        return{
            product:{},
            image:'',
            validate:false
        }
    },
    created(){
        Auth.initialize() 
        this.product.user_id = Auth.data.id
        // console.log(this.$parent.categories);
        // this.getcategories()
    },
    methods:{
        save(){
            let product = new FormData()
            product.append('name',this.product.name)
            product.append('category_id',this.product.category_id)
            product.append('quantity',this.product.quantity)
            product.append('price',this.product.price)
            product.append('description',this.product.description)
            product.append('user_id',this.product.user_id)
            if(this.validate == true){
                product.append('image',this.product.photo,this.product.photo.name)
            }
            axios.post('/product/save',product).then(res => {
                if(res.data.saved){
                    Swal.fire('Product Added Succesfully!','','success')
                    this.product = {}
                    this.$parent.test();
                }
            }
            ).catch(err => {
                Swal.fire(err.response,'','error')
                console.log(err.response);
            });
        },
        photo(event){
            if(event.target.files[0]){
                this.product.photo = event.target.files[0]
                this.image = URL.createObjectURL(this.product.photo)
                this.validate = true
            }
        }
    }
}

</script>