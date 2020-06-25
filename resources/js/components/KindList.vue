<template>
    <div class="ma-content">
        <h1>List of kinds</h1>
        <span id="axiosErrorMessage" class="ma-returnMessage"  :class="axiosErrorMessageTheme">{{ axiosErrorMessage }}</span>
        <span id="returnMessageSpan" class="ma-returnMessage"  :class="returnMessageTheme">{{ returnMessage }}</span>
        <h2>{{ emptyKindListMessage }}</h2>

        <table class="ma-tableOuter" v-if="kinds && kinds.length">
            <colgroup>
                <col class="ma-Td_Width_10">
                <col class="ma-Td_Width_60">
                <col class="ma-Td_Width_10">
                <col class="ma-Td_Width_10">
                <col class="ma-Td_Width_5">
                <col class="ma-Td_Width_5">
            </colgroup>
            <thead>
                <tr class="ma-tableRowOuterHeader">
                    <th>Name</th>
                    <th>Description</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <template v-for="kind in kinds">
            <tr class="maTableOuterRow" @click="showSpells">
                <!-- kind/SLUGNAME/edit -->
                <td>{{ kind.name }}</td>
                <td class="fixedTableTd">{{ kind.description }}</td>
                <td>{{ kind.created_at | moment("DD.MM.YYYY - hh:mm:ss") }}</td>
                <td>{{ kind.updated_at | moment("DD.MM.YYYY - hh:mm:ss") }}</td>
                <td><a :href="kindLink + kind.slug + editLink">Edit</a></td>
                <td class="ma-delete" @click.stop="deleteKind(kind.slug)">Delete</td>
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
                            <td>{{ spell.description }}</td>
                            <td>{{ spell.created_at | moment("DD.MM.YYYY - hh:mm:ss") }}</td>
                            <td>{{ spell.updated_at | moment("DD.MM.YYYY - hh:mm:ss") }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
            </template>
            <tfoot>
                <tr class="ma-tableRowOuterFooter">
                    <td colspan="6">Total Kinds: {{ totalKinds }} </td>
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
                totalKinds: 0,
                kindLink: "kind/",
                editLink: "/edit",
                returnMessage: "",
                returnMessageTheme: "",
                axiosErrorMessage: "",
                axiosErrorMessageTheme: "",
                emptyKindListMessage: "",
                kind: new Form({
                    slug: ""
                })
            }
        },
        created() {

            if(window.location.search === "?success") {
                this.returnMessage = "Kind successfully updated!";
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

            axios.get('/list/kind', {timeout: 10000 })
                .then(response => {
                    this.kinds = response.data;
                    this.totalKinds = this.kinds.length;

                    if (this.kinds.length === 0)
                    {
                        this.emptyKindListMessage = "No Kinds to display!";
                    }


                })
                .catch(error => {
                    console.error(error);
                    this.axiosErrorMessage = error;
                    this.axiosErrorMessageTheme = "returnMessageFailed";
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

            }, //END showSpells

            deleteKind(slug) {
                if(confirm("Are you sure?")) {
                    this.kind.slug = slug;
                    let hasSpellsInside = 0;
                    for (let i = 0; i < this.kinds.length; i++) {

                        if(this.kinds[i].slug === this.kind.slug) {

                            for (let j = 0; j < this.kinds[i].spells.length; j++) {
                                this.kind.delete("/spell/" + this.kinds[i].spells[j].slug);
                                hasSpellsInside = 1;

                            }
                            this.kind.delete("/kind/" + this.kind.slug);

                            if(hasSpellsInside === 1) {
                                event.target.parentNode.nextElementSibling.remove();
                            }
                            event.target.parentNode.remove();
                            this.totalKinds--;
                        }
                    }
                }
            }

        } //END Methods
    } //End export default

</script>

<style scoped>

</style>
