<template>
  <section>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="/home">Store</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02"
                    aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarColor01">
                    <ul class="navbar-nav me-auto">
                        <li v-if="!auth.email" class="nav-item">
                            <a class="nav-link active" href="/register">Register
                                <span class="visually-hidden"></span>
                            </a>
                        </li>
                        <li v-if="!auth.email" class="nav-item">
                            <a class="nav-link active" href="/login">Login
                                <span class="visually-hidden"></span>
                            </a>
                        </li>
                        <li v-if="auth.email" class="nav-item">
                            <a class="nav-link active btn" href="/config">Settings
                                <span class="visually-hidden"></span>
                            </a>
                        </li>
                        <li v-if="auth.email" class="nav-item">
                            <a class="nav-link active btn" href="/cart/checkout">Cart
                                <span class="visually-hidden"></span>
                            </a>
                        </li>
                        <li v-if="auth.email" class="nav-item">
                            <a @click="logout" class="nav-link active btn">Logout
                                <span class="visually-hidden"></span>
                            </a>
                        </li>
                    </ul>
                </div>
              </div>
        </nav>
  </section>
</template>

<script>
// import { log } from 'console'
import Auth from '../helpers/auth'
export default {
    data(){
        return{
            auth: '',
            user: ''
        }
    },
    mounted(){
        Auth.initialize()
        this.index()
    },
    methods:{
        index(){
            this.auth = Auth.data
            console.log(this.auth);
        },
        logout(){
            axios.post('/sign/logout').then(res=>{
                if(res.data.logout){
                    Auth.remove()
                    window.location.href = "/login"
                }
            }).catch(err=>{
                console.log(err);
            })
        }
    }
}
</script>