<template>
    <div class="content">
        <h1>List kinds</h1>
        <!--
        <ul v-if="kinds && kinds.length">
            <li v-for="kind of kinds">
                <p>{{ kind }}</p><br>
            </li>
        </ul>-->

        <table v-if="kinds && kinds.length">
            <thead>
            <tr>
                <th>ID</th>
                <th>Slug</th>
                <th>Name</th>
                <th>Description</th>
                <th>Created</th>
                <th>Updated</th>
            </tr>
            </thead>
            <tr v-for="kind of kinds">
                <td>{{ kind.id }}</td>
                <td>{{ kind.slug }}</td>
                <td>{{ kind.name }}</td>
                <td>{{ kind.description }}</td>
                <td>{{ kind.created_at | moment("DD.MM.YYYY - hh:mm:ss") }}</td>
                <td>{{ kind.updated_at | moment("DD.MM.YYYY - hh:mm:ss") }}</td>
            </tr>
            <tfoot>
                <tr>
                    <td colspan="3">Total Kinds: {{ kinds.length }} </td>
                    <td colspan="3">Total Spells:  </td>
                </tr>
            </tfoot>
        </table>


    </div>
</template>

<script>
/*
    export default {
        name: "KindList",
        data: function() {
            return {

                status: 'Critical',
                kinds: []
            }
        },

        methods: {
            changeStatus() {
                if(this.status === 'Critical') { this.status = 'Normal'; } else { this.status = 'Critical'; }
            }
        }
    }
*/
    export default {
        data: function() {
            return {
                kinds: []
            }
        },
        created() {
            axios.get('/list/kind')
                .then(response => {
                    this.kinds = response.data
                    console.log(this.kinds);
                })
                .catch(error => {
                    console.log(error);
                })
        }
    }



</script>

<style scoped>

</style>
