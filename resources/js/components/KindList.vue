<template>
    <div class="ma-content">
        <h1>List of kinds</h1>

        <table class="ma-tableOuter" v-if="kinds && kinds.length">
            <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Edit</th>
            </tr>
            </thead>
            <template v-for="kind in kinds">
            <tr class="maTableOuterRow" @click="showSpells">
                <td>{{ kind.name }}</td>
                <td>{{ kind.description }}</td>
                <td>{{ kind.created_at | moment("DD.MM.YYYY - hh:mm:ss") }}</td>
                <td>{{ kind.updated_at | moment("DD.MM.YYYY - hh:mm:ss") }}</td>
                <!-- kind/SLUGNAME/edit -->
                <td><a :href="kindLink + kind.slug + editLink">Edit</a></td>
            </tr>
            <tr class="maTableOuterRow maTableOuterRowHidden " v-if="kind.spells && kind.spells.length">
                <td colspan="5">
                    <table class="ma-tableInner" v-bind:class="{maTableInnerShow: isActive}">
                    <!--<table class="ma-tableInner">-->
                        <thead>
                            <tr>
                                <td colspan="5"><h3>Spells of {{ kind.name }} (Total: {{ kind.spells.length }} )</h3></td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <th>Quote</th>
                                <th>Description</th>
                                <th>Created</th>
                                <th>Updated</th>
                            </tr>
                        </thead>
                        <tr v-for="spell in kind.spells">
                            <td>{{ spell.name }}</td>
                            <td>{{ spell.quote }}</td>
                            <td>{{ spell.description }}</td>
                            <td>{{ spell.created_at | moment("DD.MM.YYYY - hh:mm:ss") }}</td>
                            <td>{{ spell.updated_at | moment("DD.MM.YYYY - hh:mm:ss") }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
            </template>
            <tfoot>
                <tr>
                    <td>Total Kinds: {{ kinds.length }} </td>
                    <td colspan="3">Total Spells: </td>
                </tr>
            </tfoot>
        </table>

    </div>
</template>

<script>

    export default {
        data() {
            return {
                kinds: [],
                //link: "kind/" + this.kind.slug + "/edit",
                kindLink: "kind/",
                editLink: "/edit",
                isActive: false
            }
        },
        created() {
            //TODO Maybe use the fetch method?
            axios.get('/list/kind')
                .then(response => {
                    this.kinds = response.data
                })
                .catch(error => {
                    console.log(error);
                })
        },
        methods: {
            showSpells(e) {

                var elementRow = e.target.parentNode.nextElementSibling
                var elementRowParent = e.target.parentNode;

                if(!elementRow.classList.contains("maTableOuterRowHidden")) { return }

                if(elementRow.classList.contains("maTableOuterRowShow")) {
                    elementRow.classList.remove("maTableOuterRowShow");
                    elementRowParent.classList.remove("maTableOuterRowParentShow");
                } else {
                    elementRow.classList.add("maTableOuterRowShow");
                    elementRowParent.classList.add("maTableOuterRowParentShow");
                }

            } //END showSpells
        } //END Methods
    } //End export default

</script>

<style scoped>

</style>
