<template>
    <div class="ma-content">
        <h1>List of kinds</h1>
        <span id="returnMessageSpan" class="ma-returnMessage"  :class="returnMessageTheme">{{ returnMessage }}</span>

        <table class="ma-tableOuter" v-if="kinds && kinds.length">
            <thead>
                <tr class="ma-tableRowOuterHeader">
                    <!--TODO width are important-->
                    <th style="width: 10%;">Name</th>
                    <th style="width: 60%;">Description</th>
                    <th style="width: 10%;">Created</th>
                    <th style="width: 10%;">Updated</th>
                    <th style="width: 5%;">Edit</th>
                    <th style="width: 5%;">Delete</th>
                </tr>
            </thead>
            <template v-for="kind in kinds">
            <tr class="maTableOuterRow" @click="showSpells">
                <!-- kind/SLUGNAME/edit -->
                <td >{{ kind.name }}</td>
                <td class="fixedTableTd">{{ kind.description }}</td>
                <td >{{ kind.created_at | moment("DD.MM.YYYY - hh:mm:ss") }}</td>
                <td >{{ kind.updated_at | moment("DD.MM.YYYY - hh:mm:ss") }}</td>
                <td ><a :href="kindLink + kind.slug + editLink">Edit</a></td>
                <td  @click="deleteKind(kind.slug)">Delete</td>
            </tr>
            <tr class="maTableOuterRow maTableOuterRowHidden " v-if="kind.spells && kind.spells.length">
                <td colspan="6" class="maTableOuterRowFixedSize">

                    <!--<table class="ma-tableInner" v-bind:class="{maTableInnerShow: isActive}">-->
                    <table class="ma-tableInner">
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
                            <td style="width: 70%;">{{ spell.description }}</td>
                            <td>{{ spell.created_at | moment("DD.MM.YYYY - hh:mm:ss") }}</td>
                            <td>{{ spell.updated_at | moment("DD.MM.YYYY - hh:mm:ss") }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
            </template>
            <tfoot>
                <tr class="ma-tableRowOuterFooter">
                    <td colspan="6">Total Kinds: {{ kinds.length }} </td>
                    <!--<td colspan="5">Total Spells: </td>-->
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
                kindLink: "kind/",
                editLink: "/edit",
                //isActive: false,
                returnMessage: "Test Message",
                returnMessageTheme: "",
            }
        },
        created() {

            if(window.location.search === "?success") {
                this.returnMessage = "Kind erfolgreich upgedated";
                this.returnMessageTheme = "returnMessageSuccess";

                window.setTimeout(function(){

                   let element = document.getElementById("returnMessageSpan");
                    console.log(element);
                    let op = 1;  // initial opacity
                    let timer = setInterval(function () {
                        if (op <= 0.1){
                            clearInterval(timer);
                            element.style.display = 'none';
                        }
                        element.style.opacity = op;
                        element.style.filter = 'alpha(opacity=' + op * 100 + ")";
                        op -= op * 0.1;
                    }, 20);

                }, 4000);
            }

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
                //TODO VUE CLASSBINDING
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

            }, //END showSpells
            deleteKind(slug) {
                console.log("DELETE KIND");

                //e.stopPropagation();
                console.log('Slug: ' + slug);

                //this.kind.delete("/kind/")

            }

        } //END Methods
    } //End export default

</script>

<style scoped>

</style>
