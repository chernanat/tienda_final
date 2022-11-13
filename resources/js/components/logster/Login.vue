<template>
  <section class="container">
        <h2 class="mt-2 text-center">Login</h2>
        <form class="mt-5" method="post" v-on:submit.prevent="login()">
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
                <input class="btn btn-success" type="submit" value="Login">
            </div>
        </form>
  </section>
</template>

<script>
import Auth from '../helpers/auth'

export default {
    components:{
        
    },
    mounted(){
        Auth.initialize()
        this.auth.user_id = Auth.data.id
    },
    data(){
        return{
            user:{},
            auth:''
        }
    },
    methods:{
        login(){
                axios.post('/sign/login',this.user).then(res => {
                    Auth.set(this.user.email,this.user.name,res.data.user.id)
                    window.location.href = "/home"
                    console.log(res.data);
                }
                ).catch(err => {
                    console.log(err)
                    Swal.fire(
                        'Sorry, Your credentials are Incorrect!',
                        err,
                        'error'
                        )
                });
            }

        }
}
</script>