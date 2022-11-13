import './bootstrap';

import swal from 'sweetalert2';
window.Swal = swal;

import './bootstrap';

// import Vue from 'vue'
import Vue from 'vue'

// import IndexCategory from './components/category/IndexCategory.vue'

import AppIndex from './components/App.vue'
import LoginUser from './components/logster/Login.vue'
import RegisterUser from './components/logster/Register.vue'
import LayoutNav from './components/layout/Layout.vue'
import HomeIndex from './components/Home.vue'
import CartIndex from './components/cart/IndexCart.vue'
// import los componentes

new Vue({
    el: '#app',
    components:{
        LoginUser,
        RegisterUser,
        AppIndex,
        LayoutNav,
        HomeIndex,
        CartIndex
    }
})
