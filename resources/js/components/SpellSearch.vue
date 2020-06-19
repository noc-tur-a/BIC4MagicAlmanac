<template>
    <div>
        <h1>Search spell</h1>
        <template>
            <form id="kindForm" @submit.prevent>

                <label for="name">Search:</label>
                <input list="spells" name="name" id="name" class="inputText" placeholder="Suchtext" autocomplete="false" v-model.trim="spell.name">
                <datalist id="spells" >
                    <template v-for="currentSpell in currentSpells">
                        <option>{{ currentSpell.name }}</option>
                    </template>
                </datalist>
                <br>

                <input type="submit" name="submit" value="Search" class="submit" @click="searchSpell()">
                <span class="returnMessage"  :class="returnMessageTheme">{{ returnMessage }}</span>
            </form>

            <p v-if="results && results.length">Found: {{ results.length }} spells</p>
            <!-- Key is needed to update the view: https://michaelnthiessen.com/force-re-render/ -->
            <div v-for="(result, index) in results" :key="index">
                <p><a :href="result.slug">{{ result.name }}</a></p>
            </div>

        </template>

    </div>
</template>

<script>
    export default {

        data: function() {
            return {
                results: [],
                returnMessage: "",
                returnMessageTheme: "",
                spell: new Form({
                    name: ""
                }),
                kinds: []

            }
        },

        props: ['currentSpells'],

        methods: {

            searchSpell() {
                this.returnMessage = "";
                this.returnMessageTheme = "";
                this.results = [];

                const regEx = new RegExp(this.spell.name,"gi");

                for(let i = 0, j = 0; i < this.currentSpells.length; i++) {
                    if(this.currentSpells[i].name.match(regEx)
                        || this.currentSpells[i].quote.match(regEx)
                        || this.currentSpells[i].description.match(regEx)
                        || this.currentSpells[i].created_at.match(regEx)
                        || this.currentSpells[i].updated_at.match(regEx)) {

                        //console.log("Found: " + this.currentSpells[i].name);
                        this.results[j] = {slug: "/spell/" + this.currentSpells[i].slug, name: this.currentSpells[i].name};
                        j++;
                    }
                }

                if(this.results.length === 0) {
                    this.returnMessage = "Leider keine Spells gefunden.";
                    this.returnMessageTheme = "returnMessageFailed";
                    console.log(this.returnMessage)
                }

                //Possibility to force a vue rerender
                //this.$forceUpdate();
                for(let i = 0; i < this.results.length; i++) {
                    console.log(this.results[i]);
                }
                this.spell.reset();

            }
        }
    }
</script>

<style scoped>
    form {
        margin-bottom: 20px;
        margin-left: 30px;
    }
    p {
        font-size: 1.2em;
    }
</style>
