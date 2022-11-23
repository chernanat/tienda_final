<template>
    <section class="container">
        <h2 class="mt-2 text-center">Register User</h2>
        <form class="mt-5" method="post" v-on:submit.prevent="save()">
            <div>
                <label class='form-label'>Name:</label>
                <input v-model="user.name" class='form-control' type="text">
            </div>
            <div>
                <label class='form-label'>Email:</label>
                <input v-model="user.email" class='form-control' type="email">
            </div>
            <div>
                <label class='form-label'>Password:</label>
                <input v-model="user.password" class='form-control' type="password">
            </div>
            <br>
            <div class="d-grid gap-2 text-center">
                <input class="btn btn-success" type="submit" value="Register">
            </div>
        </form>
    </section>
</template>

<script>

export default {
    components:{
        
    },
    data(){
        return{
            user:{}
        }
    },
    methods:{
        save(){
            axios.post('/save',this.user).then(res => {
                console.log(this.user);
                if(res.data.saved){
                    window.location.href = '/login'
                }
            }
            ).catch(err => {
                if(err.response.status == 422){
                    Swal.fire('Ops!', err.response.data.message,'error')
                }
                if(err.response.status == 500){
                    Swal.fire('Error!', 'This Email Already Exists!!!','error')
                }            
            });
        }
    }
}
</script>