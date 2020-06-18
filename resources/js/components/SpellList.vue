<template>
    <div>
        <h1>List spells</h1>
        <table class="ma-tableOuter" v-if="spells && spells.length">
            <thead>
            <tr class="ma-tableRowOuterHeader">
                <th>Name</th>
                <th>Quote</th>
                <th>Description</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <template v-for="spell in spells">
                <tr class="maTableOuterRow" @click="showKind">
                <!--<tr class="maTableOuterRow">-->
                    <td>{{ spell.name }}</td>
                    <td>{{ spell.quote }}</td>
                    <td>{{ spell.description }}</td>
                    <td>{{ spell.created_at | moment("DD.MM.YYYY - hh:mm:ss") }}</td>
                    <td>{{ spell.updated_at | moment("DD.MM.YYYY - hh:mm:ss") }}</td>
                    <!-- kind/SLUGNAME/edit -->
                    <!--<td><a :href="kindLink + kind.slug + editLink">Edit</a></td>-->
                    <td>Edit</td>
                    <!--<td @click="deleteKind(kind.slug)">Delete {{ kind.slug }}</td>-->
                    <td>Delete</td>
                </tr>
                <tr class="maTableOuterRow maTableOuterRowHidden " v-if="spell.kind">
                    <td colspan="7" class="maTableOuterRowFixedSize">
                        <!--<table class="ma-tableInner" v-bind:class="{maTableInnerShow: isActive}">-->
                        <table class="ma-tableInner" style="width: 100%;">
                      <!--      <colgroup>
                                <col class="ma-tableInnerTd_10">
                                <col class="ma-tableInnerTd_70">
                                <col span="2" class="ma-tableInnerTd_10">
                            </colgroup>-->
                            <thead>
                            <tr>
                                <td colspan="4"><h3>Spells of <!--{{ kind.name }}--> (Total: <!--{{ kind.spells.length }}--> )</h3></td>
                            </tr>
                            <tr>
                                <th class="ma-tableInnerTd_10">Name</th>
                                <th class="ma-tableInnerTd_70">Description</th>
                                <th class="ma-tableInnerTd_10">Created</th>
                                <th class="ma-tableInnerTd_10">Updated</th>
                            </tr>
                            </thead>
                            <!--<tr v-for="kind in spell.kind">-->
                            <tr>
                                <td class="ma-tableInnerTd_10">{{ spell.kind.name }}</td>
                                <td class="ma-tableInnerTd_70">{{ spell.kind.description }}</td>
                                <td class="ma-tableInnerTd_10">{{ spell.kind.created_at | moment("DD.MM.YYYY - hh:mm:ss") }}</td>
                                <td class="ma-tableInnerTd_10">{{ spell.kind.updated_at | moment("DD.MM.YYYY - hh:mm:ss") }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </template>
            <tfoot>
            <tr class="ma-tableRowOuterFooter">
                <td>Total Kinds: <!--{{ kinds.length }}--> </td>
                <td colspan="7">Total Spells: </td>
            </tr>
            </tfoot>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                spells: [],
                spellLink: "spell/",
                editLink: "/edit",
                returnMessage: "Test Message",
                returnMessageTheme: "",
            }
        },
        created() {

            if(window.location.search === "?success") {
                this.returnMessage = "Spell erfolgreich upgedated";
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
            axios.get('/list/spell')
                .then(response => {
                    this.spells = response.data
                    console.log(this.spells);
                })
                .catch(error => {
                    console.log(error);
                })
        },

        methods: {
            showKind(e) {
                console.log("showKind");
                //TODO VUE CLASSBINDING
                var elementRow = e.target.parentNode.nextElementSibling
                var elementRowParent = e.target.parentNode;

                if(!elementRow.classList.contains("maTableOuterRowHidden")) {
                    return
                }
                if(elementRow.classList.contains("maTableOuterRowShow")) {
                    elementRow.classList.remove("maTableOuterRowShow");
                    elementRowParent.classList.remove("maTableOuterRowParentShow");
                } else {
                    elementRow.classList.add("maTableOuterRowShow");
                    elementRowParent.classList.add("maTableOuterRowParentShow");
                }
            }
        }
    }
</script>

<style scoped>

</style>
