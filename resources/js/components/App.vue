<template>
    <section class="container">
        <index-category></index-category>
        <index-product :categories="categories"></index-product>
    </section>
</template>

<script>
import IndexCategory from './category/IndexCategory.vue'
import IndexProduct from './products/IndexProduct.vue'
import Auth from './helpers/auth'

export default {
    props:[
        'categories'
    ],
    components:{
        IndexCategory,
        IndexProduct
    },
    created(){
        Auth.initialize() 
        this.user.user_id = Auth.data.id
        this.logged()
    }
    ,
    data(){
        return{
            user:{
                user_id: null
            }
        }
    },
    methods:{
        logged(){
            if(this.user.user_id == null){
                window.location.href = "/login"
            }
        }
    }
}
</script>