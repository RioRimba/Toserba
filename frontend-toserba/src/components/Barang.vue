<template>
	<div class="container-fluid">
		<div class="row bg-dark">
			<div class="col-lg-12">
				<p class="text-center text-light display-4 pt-2" style="font size:25px">Barang</p>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row mt-3">
			<div class="col-lg-6">
				<h3 class="text-info">List Barang</h3>
			</div>
			<div class="col-lg-6">
				<router-link button class="btn btn-info floatt-right" :to="{path:'/TambahBarang'}">
					<i class="fas fa-boxes"></i>&nbsp;&nbsp; Add Barang</router-link>
			</div>
		</div>
		<hr class="bg-info">
		<div class="alert alert-danger" v-if="errorMsg">
			Error Message
		</div>
		<div class="alert alert-success" v-if="successMsg">
			Success Message
		</div>
	</div>


	<div class="container">
	<div class="col-md-12">
		<input type="text" name="search" v-model=search class="form-control" placeholder="search">
	</div>
	<div class="col-md-12">
		<button class="btn btn-success" v-on:click="cari_data()">search</button>
	</div>
	<br>
		<div style="overflow-x:auto">
			<table class="table table-hover table-striped">
				<thead>
					<tr>
						<th>ID</th><th>Nama Barang</th><th>Stock</th><th>Harga</th><th>Edit</th><th>Delete</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="bar in barang" :key="bar.id_barang">
						<td>{{bar.id_barang}}</td>
						<td>{{bar.nama_barang}}</td>
						<td>{{bar.stock}}</td>
						<td>Rp.{{bar.harga}}</td>
						<td><router-link class="text-success" :to="{path:'/EditBarang/'+bar.id_barang}">
						<i class="fas fa-edit"></i></router-link></td>
						<td><a class="text-danger" @click="deletebarang(bar.id_barang)"><i class="fas fa-trash"></i></a></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</template>

<script>
	export default{
		name:"Barang",
		emits: ["authenticated", "level", "name"],
		data(){
			return{
				barang:[],
				search:"",
				errorMsg:false,
				successMsg:false,
				AddModal:false,
				EditModal:false,
			}
		},
		
		methods:{
			tm_barang:function(){
				var option = {
					headers:{Authorization:'bearer '+localStorage.getItem('token')}
				}
				this.axios.get('http://localhost/toserba/backend-toserba/public/api/get_barang', option).then((result)=>{
					this.barang=result.data
				})
			},
			cari_data:function(){
				var option = {
					headers:{Authorization:'bearer '+localStorage.getItem('token')}
				}
				var data_cari=""
				if(this.search==""){
					data_cari= ""
				}else{
					data_cari= "/" + this.search
				}
				this.axios.get("http://localhost/toserba/backend-toserba/public/api/get_barang"+data_cari, option).then((result)=>{
					this.barang=result.data
				})
			},
			deletebarang:function(id_barang){
				var option = {
					headers:{Authorization:'bearer '+localStorage.getItem('token')}
				}
				this.axios.delete("http://localhost/toserba/backend-toserba/public/api/deletebarang/"+id_barang, option).then((result)=>{
					console.log(result)
					this.tm_barang()
				})
			},
		},
		mounted(){
			this.tm_barang()
		}
	}
</script>