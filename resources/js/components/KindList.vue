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
            </tr>
            </thead>
            <template v-for="kind in kinds">
            <tr class="maTableOuterRow" @click="showSpells">
                <td>{{ kind.name }}</td>
                <td>{{ kind.description }}</td>
                <td>{{ kind.created_at | moment("DD.MM.YYYY - hh:mm:ss") }}</td>
                <td>{{ kind.updated_at | moment("DD.MM.YYYY - hh:mm:ss") }}</td>
            </tr>
            <tr class="maTableOuterRow maTableOuterRowHidden " v-if="kind.spells && kind.spells.length">
                <td colspan="4">
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
                isActive: false
            }
        },
        created() {
            axios.get('/list/kind')
                .then(response => {
                    this.kinds = response.data
                    console.log(this.kinds);
                    /*
                    for(let i = 0; i < this.kinds.length; i++) {
                        console.log("Kinds: " + this.kinds[i].id);
                        console.log("this.kinds[i].spells.length: " + this.kinds[i].spells.length)
                        for(let j = 0; j < this.kinds[i].spells.length; j++) {
                            console.log("Spells: " + this.kinds[i].spells[j].id + " " + this.kinds[i].spells[j].name);
                        }
                    }
                    */

                })
                .catch(error => {
                    console.log(error);
                })
        },
        methods: {
            showSpells(e) {

                //this.isActive = !this.isActive;
                var elementRow = e.target.parentNode.nextElementSibling
                var elementRowParent = e.target.parentNode;
                //var element = e.target.parentNode.nextElementSibling.childNodes[0].childNodes[0];

                if(!elementRow.classList.contains("maTableOuterRowHidden")) { return }

                if(elementRow.classList.contains("maTableOuterRowShow")) {
                    elementRow.classList.remove("maTableOuterRowShow");
                    elementRowParent.classList.remove("maTableOuterRowParentShow");
                    //element.classList.remove("maTableInnerShow");
                } else {
                    elementRow.classList.add("maTableOuterRowShow");
                    elementRowParent.classList.add("maTableOuterRowParentShow");
                    //element.classList.add("maTableInnerShow");
                }

            } //END showSpells
        } //END Methods
    } //End export default

</script>

<style scoped>

</style>
