<template>
    <div>
        <h1>Show spell</h1>

        <table>
            <tr>
                <td>Name:</td>
                <td>{{ currentSpell.name }}</td>
            </tr>
            <tr>
                <td>Created:</td>
                <td>{{ currentSpell.created_at | moment("DD.MM.YYYY - hh:mm:ss") }}</td>
            </tr>
            <tr>
                <td>Updated:</td>
                <td>{{ currentSpell.updated_at | moment("DD.MM.YYYY - hh:mm:ss") }}</td>
            </tr>
            <tr>
                <td>Quote:</td>
                <td>{{ currentSpell.quote }}</td>
            </tr>
            <tr>
                <td>Description:</td>
                <td>{{ currentSpell.description }}</td>
            </tr>
            <tr>
                <td colspan="2"><a href="/search/spell"><button class="submit">Back</button></a></td>

            </tr>

        </table>


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

        props: ['currentSpell'],

        methods: {
            changeStatus() {
                if(this.status === 'Critical') { this.status = 'Normal'; } else { this.status = 'Critical'; }
            }
        }
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
