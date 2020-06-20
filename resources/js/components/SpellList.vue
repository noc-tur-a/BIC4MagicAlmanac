<template>
    <div>
        <h1>List of spells</h1>
        <span id="axiosErrorMessage" class="ma-returnMessage"  :class="axiosErrorMessageTheme">{{ axiosErrorMessage }}</span>
        <span id="returnMessageSpan" class="ma-returnMessage"  :class="returnMessageTheme">{{ returnMessage }}</span>
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
                    <td><a :href="spellLink + spell.slug + editLink">Edit</a></td>
                    <td class="ma-delete" @click.stop="deleteSpell(spell.slug)">Delete</td>
                </tr>
                <tr class="maTableOuterRow maTableOuterRowHidden " v-if="spell.kind">
                    <td colspan="7" class="maTableOuterRowFixedSize">
                        <!--<table class="ma-tableInner" v-bind:class="{maTableInnerShow: isActive}">-->
                        <table class="ma-tableInner" style="width: 100%;">
                            <colgroup>
                                <col class="ma-Td_Width_10">
                                <col class="ma-Td_Width_70">
                                <col class="ma-Td_Width_10">
                                <col class="ma-Td_Width_10">
                            </colgroup>
                            <thead>
                            <tr>
                                <td colspan="4"><h3>Spell of Kind {{ spell.kind.name }}</h3></td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Created</th>
                                <th>Updated</th>
                            </tr>
                            </thead>
                            <!--<tr v-for="kind in spell.kind">-->
                            <tr>
                                <td>{{ spell.kind.name }}</td>
                                <td>{{ spell.kind.description }}</td>
                                <td>{{ spell.kind.created_at | moment("DD.MM.YYYY - hh:mm:ss") }}</td>
                                <td>{{ spell.kind.updated_at | moment("DD.MM.YYYY - hh:mm:ss") }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </template>
            <tfoot>
            <tr class="ma-tableRowOuterFooter">
                <td colspan="7">Total Spells: {{ totalSpells }}</td>
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
                totalSpells: 0,
                spellLink: "spell/",
                editLink: "/edit",
                returnMessage: "",
                returnMessageTheme: "",
                axiosErrorMessage: "",
                axiosErrorMessageTheme: "",
                spellDelete: new Form({
                    slug: ""
                })
            }
        },
        created() {

            if(window.location.search === "?success") {
                this.returnMessage = "Spell successfully updated!";
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

            axios.get('/list/spell', {timeout: 10000 })
                .then(response => {
                    this.spells = response.data
                    this.totalSpells = this.spells.length;
                })
                .catch(error => {
                    console.error(error);
                    this.axiosErrorMessage = error;
                    this.axiosErrorMessageTheme = "returnMessageFailed";
                })
        },

        methods: {
            showKind(e) {
                console.log("showKind");
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
            },

            deleteSpell(slug) {

                this.spellDelete.slug = slug;

                for(let i = 0; i < this.spells.length; i++ ) {

                    if(this.spells[i].slug === this.spellDelete.slug) {

                        if(this.spells[i].kind) {
                            event.target.parentNode.nextElementSibling.remove();
                        }
                        this.spellDelete.delete("/spell/" + this.spellDelete.slug);
                        event.target.parentNode.remove();
                        this.totalSpells--;
                    }
                }
            }

        }
    }
</script>

<style scoped>

</style>
