<template>
    <section>
        <!-- <h1 >index category</h1> -->
        <form-category></form-category>
        <br>
        <table-category v-if="load"></table-category>
    </section>
    
</template>

<script>
import FormCategory from './FormCategory.vue'
import TableCategory from './TableCategory.vue'

export default {
    components:{
        FormCategory,
        TableCategory
    },
    data(){
        return{
            load: true
        }
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