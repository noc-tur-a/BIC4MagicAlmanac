
<script src="../utilities/Form.js"></script>
<template>
	<div>
		<h1>Edit Spell</h1>
		<template>
			<form @submit.prevent>
				<input type="hidden" name="id" v-model="spell.id">
                <input type = "hidden" name="slug" v-model="kind.slug">
				<label>Updated:</label>
                <span class="inputText">{{ spell.updated_at | moment("DD.MM.YYYY - HH:mm:ss") }}</span>
                <br>
                <label>Created:</label>
                <span class="inputText">{{ spell.created_at | moment("DD.MM.YYYY - HH:mm:ss") }}</span>
                <br>
                <label for="name">Name:</label>





			</form>





		</template>




	</div>










	<div>
		<p>Server status: {{ status }}</p>
		<button @click="changeStatus">Change Status</button>
		<p>Some text</p>
	</div>
</template>

<script>
	export default {
		name: "test",
		data: function() {
			return {

				status: 'Critical'
			}
		},
		methods: {
			changeStatus() {
				if(this.status === 'Critical') { this.status = 'Normal'; } else { this.status = 'Critical'; }
			}
		}
	}
</script>

<style scoped>

</style>
