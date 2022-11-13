<template>
    <section>
        <div v-if="product_edit">
            <h2>Edit Product:</h2>
            <form v-on:submit.prevent="update(product_edit.id)">
            <div>
                <div>
                    <label for="" class="form-label">Product Name:</label>
                    <input v-model="product_edit.name" class="form-control" type="text">
                </div>
            <div>
                <label class="form-label" for="">Category:</label>
                <select class="form-control" v-model="product_edit.category_id">
                    <option v-for="(category,index) in categories" :key="index" name="category" :value="category.id" >{{category.name}}</option>
                </select>
            </div>
                <div>
                    <label for="" class="form-label">Quantity:</label>
                    <input v-model="product_edit.quantity" class="form-control" type="number">
                </div>  
            <div>
                <label class="form-label" for="">Image:</label>
                <input class="form-control" type="file" @change="photo">
                <div class="d-flex justify-content-center justify-content-center mt-2">
                    <img style="width:250px" :src="product_edit.photo" alt="200">
                </div>
            </div>  
                <div>
                    <label for="" class="form-label">Price:</label>
                    <input v-model="product_edit.price" class="form-control" type="number">
                </div>  
                <div>
                    <label for="" class="form-label">Description:</label>
                    <input v-model="product_edit.description" class="form-control" type="text">
                </div>  
                <br>

                <div class="d-grid gap-2 d-flex justify-content-center justify-content-center">
                    <input type="submit" value="Update Product" class="btn btn-warning">
                    <form v-on:submit.prevent="close()">
                        <div class="d-grid gap-2">
                            <input type="submit" value="Cancel" class="btn btn-secondary">
                        </div>
                    </form>
                </div>
            </div>
            </form>
        </div>
        <table class="table table-hover" id="test">
            <thead>
            <tr>
                <th scope="col">Product Name</th>
                <th scope="col">Category</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col">Description</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
                <tr class="table-primary" v-for="(product,index) in products" :key="index">
                    <td v-if="product.user_id == auth.id">{{product.name}}</td>
                    <td v-if="product.user_id == auth.id">{{product.category.name}}</td>
                    <td v-if="product.user_id == auth.id">{{product.quantity}}</td>
                    <td v-if="product.user_id == auth.id">{{product.price}}</td>
                    <td v-if="product.user_id == auth.id">{{product.description}}</td>
                    <td v-if="product.user_id == auth.id">                  
                        <input @click="edit(product.id)" class="btn btn-warning " type="submit" value="Edit">
                        <input @click="del(product.id)" class="btn btn-danger btn-delete" type="submit" value="Delete">
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
</template>

<script>
import Swal from 'sweetalert2';
import Auth from '../helpers/auth'
export default {
    data(){
        return{
            categories:[],
            products:[],
            image:'',
            validate:false,
            product_edit: null,
            auth:''
        }
    },
    created(){
        this.getProduct()
        this.getcategories()
        Auth.initialize()
        this.auth = Auth.data
    },
    methods:{
        getcategories(){
            axios.get('/product/categories').then(res=>{
                // console.log(res.data);
                this.categories = res.data
            }).catch(err=>{
                console.log(err);
            })
        },
        table(){
            this.$nextTick(()=>{
                $('#test').DataTable()
            });
        },  
        getProduct(){
            axios.get('/product/').then(res=>{
                // console.log(res.data);
                this.products = res.data
                this.table();
            }).catch(err=>{
                console.log(err);
            })
        },
        edit(id){
            axios.get(`/product/edit/${id}`, this.products).then(res=>{
                // console.log(this.products);
                res => res.data
                // console.log(res.data);
                this.product_edit = res.data
            })
            .catch(err=> console.log(err))
        },
        update(id){
            let product = new FormData()
            product.append('name',this.product_edit.name)
            product.append('category_id',this.product_edit.category_id)
            product.append('quantity',this.product_edit.quantity)
            product.append('price',this.product_edit.price)
            product.append('description',this.product_edit.description)
            if(this.validate == true){
                product.append('image',this.product_edit.photo,this.product_edit.photo.name)
            }
            axios.post(`/product/edit/${id}`,product).then(res=>{
                this.getProduct()
                this.getcategories()
                if(res.data.update){
                    Swal.fire('Product Updated Successfully!', '','success')
                    this.product_edit = {}
                }
            }).catch(err=>{
                if(err.response.status === 500){
                    Swal.fire('Product Cannot Have Fields Empty!', '','error')
                }
            })
        },
        del(id){  
            axios.get(`/product/delete/${id}`).then(
                this.getProduct(),
                this.getcategories(),
                Swal.fire('Product Deleted Successfully!', '','success'),
                res => console.log(res)).
            catch(err => console.log(err))
        },
        close(){
            this.product_edit = null
        },
        photo(event){
            if(event.target.files[0]){
                this.product_edit.photo = event.target.files[0]
                this.image = URL.createObjectURL(this.product_edit.photo)
                this.validate = true
            }
        }
    }
}
</script>