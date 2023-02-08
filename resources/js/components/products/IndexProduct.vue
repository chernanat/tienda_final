<template>
    <section>
        <form-product :categories="categories">
        </form-product>
        <br>
        <table-product v-if="load">
        </table-product>
    </section>
</template>

<script>
import FormProduct from './FormProduct.vue'
import TableProduct from './TableProduct.vue'
export default {
    props:[
        'categories'
    ],
    data(){
        return{
            load: true
        }
    },
    components:{
        FormProduct,
        TableProduct
    },
    methods:{
        test(){
            this.load = false
            setTimeout(() => {
                this.load = true;
            }, 200);
        }
    }
}
</script>