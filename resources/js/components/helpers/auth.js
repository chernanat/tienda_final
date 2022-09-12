export default {
    data:{
        username:null,
        email:null,
        id:null
    },
    initialize(){
        this.data.username = localStorage.getItem('username')
        this.data.email = localStorage.getItem('email')
        this.data.id = localStorage.getItem('id')
    },
    set(email, username,id ){
        localStorage.setItem('username', username)
        localStorage.setItem('email', email)
        localStorage.setItem('id', id)
        this.initialize()
    },
    remove(){
        localStorage.removeItem('username')
        localStorage.removeItem('email')
        localStorage.removeItem('id')
        this.initialize()
    }
}