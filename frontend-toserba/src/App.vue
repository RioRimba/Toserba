<template>
  <div>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" style="font-weight:700;">TOSERBA</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapse" aria-controls="collapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="collapse" v-if="authenticated">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item active">
          <router-link class="nav-link" to="/Home">Home</router-link>
        </li>
        <li class="nav-item" v-if="level=='pelanggan'">
          <router-link class="nav-link" to="/pelangganBarang">Barang</router-link>
        </li>

        <li class="nav-item" v-if="level=='kasir'">
          <router-link class="nav-link" to="/Barang">Barang</router-link>
        </li>
         <li class="nav-item" v-if="level=='kasir'">
          <router-link class="nav-link" to="/RegisterAdmin">Tambah Admin</router-link>
        </li>

        <li class="nav-item">
          <router-link class="nav-link" to="/" @click="logout()">Logout</router-link>
        </li>
      </ul>
    </div>
  </nav>    
  </div>
  <div>
    <router-view @authenticated="setAuthenticated" @level="setLevel" @name="setName"></router-view>
  </div>
</template>

<script>
export default {
  name: 'App',
  data() {
    return {
      authenticated:JSON.parse(localStorage.getItem('status')),
      level:JSON.parse(localStorage.getItem('status')),
      name:JSON.parse(localStorage.getItem('status')),
    }
  },
  mounted() {
    if(!this.authenticated) {
      this.$router.replace({name:"Login"});
    }
  },
  methods: {
    setAuthenticated(status) {
      this.authenticated=status
    },
    setLevel(status) {
      this.level=status
    },
    setName(status) {
      this.name=status
    },
    logout() {
      this.authenticated=false
      localStorage.removeItem('status')
      localStorage.removeItem('token')
      localStorage.removeItem('level')
      localStorage.removeItem('name')      
    }
  }
}
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Asap:wght@400;600;700&display=swap');
#app {
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin:0px;
}
*{
  font-family: 'Asap', sans-serif;
  font-size:20px;
}

/*halaman login*/
h1{
  padding-top:20px;
  padding-bottom:20px;
}
.form-control{
  margin-top:10px;
  margin-bottom:15px;
}
.footer{
  position:fixed;
  left:0;
  bottom:0;
  width:100%;
  background-color:#04D4F0;
  color:white;
  text-align:center;
  pading:10px;
}
.footer > p{
  margin:10px 10px;
}
#btnLogin{
  margin:10px 0px 10px 10px;
  padding: 8px 50px;
}
#btnRegister{
  margin:10px 10px 10px 0px;
  padding: 8px 50px;
}
</style>