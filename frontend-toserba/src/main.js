import { createApp } from 'vue'
import App from './App.vue'
import axios from 'axios'
import store from './store.js'

import {createWebHistory, createRouter} from 'vue-router'
import Barang from './components/Barang.vue'
import Home from './components/Home.vue'
import TambahBarang from './components/TambahBarang.vue'
import EditBarang from './components/EditBarang.vue'
import Login from './components/Login';
import Register from './components/Register.vue'
import PelangganBarang from './components/PelangganBarang.vue';
import RegisterAdmin from './components/RegisterAdmin.vue';

const router = createRouter({
	history:createWebHistory(),
	routes:[
		{path:'/', name:"Login", component:Login},
		{path:'/Home', name:'Home', component:Home},
		{path:'/Barang', name:'Barang', component:Barang},
		{path:'/TambahBarang', name:"TambahBarang", component:TambahBarang},
		{path:'/EditBarang/:id_barang', name:"EditBarang", component:EditBarang},
		{path:'/PelangganBarang', name:"PelangganBarang", component:PelangganBarang},
		{path:'/Register', name:"Register", component:Register},
		{path:'/RegisterAdmin', name:"RegisterAdmin", component:RegisterAdmin},
	],
	base:'/'
})

const app = createApp(App)
app.use(store)
app.use(router)
app.config.globalProperties.axios = axios
app.mount("#app")
