<template>
	<div>
		<h1>Show kind</h1>

		<table>
			<tr>
                <td>Name: </td>
				<td>{{ currentKind.name }}</td>
			</tr>
			<tr>
				<td>Created:</td>
				<td>{{ currentKind.created_at | moment("DD.MM.YYYY - hh:mm:ss") }}</td>
			</tr>
			<tr>
				<td>Updated:</td>
				<td>{{ currentKind.updated_at | moment("DD.MM.YYYY - hh:mm:ss") }}</td>
			</tr>
			<tr>
				<td>Description:</td>
				<td>{{ currentKind.description }}</td>
			</tr>
			<tr>
				<td colspan="2"><a href="/kind"><button class="submit">Back</button></a></td>
			</tr>
		</table>
	</div>
</template>

<script>
	export default {
		data: function() {
			return {

				status: 'Critical'
			}
		},

		props: ['currentKind'],

	}
</script>

<style scoped>

    table {

        max-width:600px;
        border: 1px solid;
        border-collapse: separate;
        border-radius: 15px;
    }

    tr:last-child td {
        border-bottom: 0;
        text-align: center;
    }

    .submit {
        margin: 0;
        text-align: center;
    }

</style>
