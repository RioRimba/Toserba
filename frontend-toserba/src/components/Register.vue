<template>
	<div class="container">
		Nama : 
		<input type="text" name="name" v-model="name" class="form-control" style="text-transform:uppercase;margin:20px 0px">
		Email : 
		<input type="email" name="email" v-model="email" class="form-control" style="margin:20px 0px">
		Password : 
		<input type="Password" name="password" v-model="password" class="form-control" style="margin:20px 0px">
		Confirm Password : 
		<input type="Password" name="password_confirmation" v-model="password_confirmation" class="form-control" style="margin:20px 0px">
		<input type="hidden" name="level" value="pelanggan">
		<button class="btn btn-primary" @click="daftar()" style="margin:15px;padding:8px 40px">Daftar</button>
		<div v-bind:class="style_mess">
			<div v-if="error==true">
				<div v-for="mess in message" :key="mess.id">
					<p v-for="m in mess" :key="m.id">{{m}}</p>
				</div>
			</div>
			<div v-else>{{message}}</div>
		</div>
	</div>
</template>

<script>
	export default{
		name:"Register",
		data(){
			return{
				name:'',
				email:'',
				password:'',
				password_confirmation:'',
				level:'pelanggan',
				style_mess:'',
				message:'',
				error:false,
			}
		},
		methods:{
			daftar:function(){
				var datadaftar=
				{
					name:this.name, 
					email:this.email, 
					password:this.password,
					password_confirmation:this.password_confirmation,
					level:this.level,
				}
				this.axios.post("http://localhost/toserba/backend-toserba/public/api/register", datadaftar).then((result)=>{
					if(result.data.status==true){
						this.error=false
						this.message=result.data.message
						this.style_mess="alert alert-success"
						setTimeout(()=>{
						this.$router.push('/')
						},2000)					
					}else{
						this.error=true
						this.style_mess="alert alert-danger"
						this.message=result.data.message
					}
					
				})
			}
		}
	}
</script>