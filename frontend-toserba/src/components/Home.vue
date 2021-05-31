<template>
	<div>
		<h1>Selamat datang {{this.$store.state.user.name}} di toserba</h1>
		hai {{this.$store.state.user.name}}
	</div>
</template>

<script>
	export default{
		name:"Home"
		
	}
</script>