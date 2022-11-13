<template>
    <!-- <h1>hola soy category</h1> -->
    <section>
        <h1 class="text-center">Category</h1>
        <h2>Create Category</h2>
        <form class="form" method="post" v-on:submit.prevent="save()">
            <div>
                <label class="form-label" for="">Category Name:</label>
                <input v-model="category.name" class="form-control" type="text" >
            </div>
            <br>
            <div class="d-grid gap-2 text-center">
                <input class="btn btn-success" type="submit" value="Register Category">
            </div>
        </form>
    </section>
</template>

<script>
import axios from 'axios'
import TableCategory from './TableCategory.vue';


export default {
    components:{
        TableCategory
    },
    data(){
        return{
            category:{}
        }
    },
    methods:{
        save(){
            axios.post('/category/save',this.category).then(res => {
                if(res.data.saved){
                    // console.log(this.category.name);
                    this.category = {}
                    this.$parent.test()
                }
            }
            ).catch(err => {
                console.log(err);
            });
        }
    }
}
</script>