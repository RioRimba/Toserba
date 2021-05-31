<template>
	<div class="container">
		<h1>Login to Toserba</h1>
		Email:
		<input type="email" v-model="email" class="form-control">
		Password:
		<input type="password" v-model="password" class="form-control">
		<router-link button class="btn btn-outline-success" id="btnRegister" :to="{path:'/Register'}">Register</router-link>
		<button class="btn btn-success" @click="login()" id="btnLogin">Login</button>		
	</div>
	<div class="footer">
		<p>Copyright ©️ Rio Rimba | 2021</p>
	</div>
</template>

<script>
	export default {
		name:"Login",
		emits: ["authenticated", "level", "name"],
		data() {
			return {
				email:'',
				password:'',
			}
		},
		methods:{
			login(){
				var datalogin = {
					email:this.email,
					password:this.password,
				};
				this.axios.post("http://localhost/toserba/backend-toserba/public/api/login", datalogin).then((result)=>{
					localStorage.setItem('token',result.data.token)
					localStorage.setItem('status', true)
					localStorage.setItem('level',result.data.level)
					localStorage.setItem('name',result.data.name)
					this.$emit('level', result.data.level)
					this.$emit('name', result.data.name)
					this.$emit('authenticated', true)
					this.$store.dispatch('setname', result.data.name)
					this.$router.replace({name:"Home"})
				}).catch(error => {
					console.log(error)
					alert('email atau password salah')
				})
			},
		},
		mounted(){
			this.$emit('authenticated', false)
		}
	}
</script>
