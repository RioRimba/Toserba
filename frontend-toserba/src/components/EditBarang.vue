<template>
	<div class="container">
		<input type="hidden" name="id_barang" v-model="id_barang">
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
		<button class="btn btn-primary" @click="editbarang()">Edit Barang</button>
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
		name:"EditBarang",
		emits: ["authenticated", "level", "name"],
		data(){
			return{
				id_barang:'',
				nama_barang:'',
				stock:'',
				harga:'',
				style_mess:'',
				message:'',
				error:false,
			}
		},
		methods:{
			detailbarang(id_barang){
				var option = {
					headers:{Authorization:'bearer '+localStorage.getItem('token')}
				}
				this.axios.get("http://localhost/toserba/backend-toserba/public/api/detail_barang/"+id_barang, option).then((result)=>{
					this.id_barang=result.data.id_barang
					this.nama_barang=result.data.nama_barang
					this.stock=result.data.stock
					this.harga=result.data.harga
				})
			},
			editbarang:function(){
				var option = {
					headers:{Authorization:'bearer '+localStorage.getItem('token')}
				}
				var databarang=
				{
					nama_barang:this.nama_barang,
					stock:this.stock,
					harga:this.harga
				}
				this.axios.put("http://localhost/toserba/backend-toserba/public/api/editbarang/"+this.id_barang, databarang, option).then((result)=>{
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
			},
		},
		mounted(){
			this.detailbarang(this.$route.params.id_barang)
		}
	}

</script>