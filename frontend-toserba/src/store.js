import {createStore} from 'vuex'

export default createStore({
	state: {
		user: {
			nama: localStorage.getItem('name')
		}
	},
	mutations: {
		CONFIRM_NAME:(state, name)=>{
			state.user.name = name
		}
	},
	actions: {
		setname({commit}, name) {
			commit("CONFIRM_NAME", name)
		}
	}
})