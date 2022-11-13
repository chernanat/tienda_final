<template>
    <section>
        <div v-if="category_edit">
            <h2>Edit Category:</h2>
            <form v-on:submit.prevent="update(category_edit.id)">
            <div>
                <div>
                    <label for="" class="form-label">Name:</label>
                    <input v-model="category_edit.name" class="form-control" type="text">
                </div>  
                <br>
                <div class="d-grid gap-2 d-flex justify-content-center justify-content-center">
                    <input type="submit" value="Update Category" class="btn btn-warning">
                    <form v-on:submit.prevent="close()">
                        <div class="d-grid gap-2">
                            <input type="submit" value="Cancel" class="btn btn-secondary">
                        </div>
                    </form>
                </div>
            </div>
            </form>
        </div>
        <table class="table table-hover mt-2">
            <thead>
              <tr>
                <th scope="col">Category</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
            <tr class="table-primary" v-for="(categories, index) in category" :key="index">
                <td>{{categories.name}}</td>
                <td class="">                  
                    <input @click="edit(categories.id)" class="btn btn-warning " type="submit" value="Edit">
                    <input @click="del(categories.id)" class="btn btn-danger btn-delete" type="submit" value="Delete">
                </td>
            </tr>
            </tbody>
          </table>
    </section>
</template>

<script>
import Swal from 'sweetalert2';

export default {

    data(){
        return{
            category:{
                
            },
            category_edit: null
        }
    },
    created(){
        this.getcategories()
    },
    methods:{
        getcategories(){
            axios.get('/category/').then(res=>{
                this.category = res.data
            }).catch(err=>{
                console.log(err);
            })
        },
        edit(id){
            axios.get(`/category/edit/${id}`,).then(res=>{
                res => res.data
                this.category_edit = res.data
            })
            .catch(err=> console.log(err))
        },
        update(id){
            axios.post(`/category/edit/${id}`,this.category_edit).then(res=>{
                Swal.fire('Category Updated Succesfully !', '' ,'success'),
                this.getcategories()
            }).catch(err=>{
                Swal.fire(err.response.data.message+ ' !','','error')
            })
        },
        del(id){  
            axios.get(`/category/delete/${id}`).then(
                Swal.fire('Category Deleted Succesfully!','','success'),
                this.getcategories(),
                res => console.log(res)).
            catch(err => console.log(err))
        },
        close(){
            this.category_edit = null
        }
    }
}
</script>