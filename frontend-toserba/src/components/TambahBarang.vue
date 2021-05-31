<template>
	<div class="container">
		Nama Barang : 
		<input type="text" name="nama_barang" v-model="nama_barang" class="form-control">
		<br>
		Stock : 
		<input type="text" name="stock" v-model="stock" class="form-control">
		<br>
		Harga : 
		<input type="text" name="harga" v-model="harga" class="form-control">
		<br>
		<br>
		<button class="btn btn-primary" @click="simpanbarang()">Simpan</button>
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
		name:"TambahBarang",
		emits: ["authenticated", "level", "name"],
		data(){
			return{
				nama_barang:'',
				stock:'',
				harga:'',
				style_mess:'',
				message:'',
				error:false,
			}
		},
		methods:{
			simpanbarang:function(){
				var option = {
					headers:{Authorization:'bearer '+localStorage.getItem('token')}
				}
				var databarang=
				{
					nama_barang:this.nama_barang, 
					stock:this.stock, 
					harga:this.harga
				}
				this.axios.post("http://localhost/toserba/backend-toserba/public/api/insert_barang", databarang, option).then((result)=>{
					if(result.data.status==true){
						this.error=false
						this.message=result.data.message
						this.style_mess="alert alert-success"
						setTimeout(()=>{
								this.$router.push('/Barang')
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