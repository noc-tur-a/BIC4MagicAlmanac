<template>
    <div>
        <h1>Create spell</h1>
        <template>
            <form id="spellForm" @submit.prevent>

                <label for="name">Name:</label>
                <input required="required" type="text" id="name" name="name" class="inputText"
                       v-model.trim="spell.name" @focus.stop="removeMessage" @keypress.stop="removeMessage">
                <br>
                <label for="quote" class="labelTextArea">Quote:</label>
                <input required="required" id="quote" name="quote" class="inputText"
                       v-model.trim="spell.quote" @focus.stop="removeMessage" @keypress.stop="removeMessage">
                <br>
                <label for="kindId" class="labelTextArea">Kind Id:</label>
                <select id="kindId" required="required" class="inputText"
                        v-model="optionValue" @change.stop="removeMessage">
                    <template v-for="currentKind in currentKinds">
                        <option v-bind:value="{ value: currentKind.id }" >{{ currentKind.name }}</option>
                    </template>
                </select>
                <br>
                <label for="description" class="labelTextArea">Description:</label>
                <textarea required="required" id="description" name="description" class="inputTextarea"
                          v-model.trim="spell.description" @focus.stop="removeMessage" @keypress.stop="removeMessage"></textarea>
                <br>

                <input type="submit" name="submit" value="Create" class="submit" @click="createSpell()">
                <span class="returnMessage"  :class="returnMessageTheme">{{ returnMessage }}</span>

            </form>


        </template>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                returnMessage: "",
                returnMessageTheme: "",
                optionValue: "",
                spell: {
                    name: "",
                    quote: "",
                    description: "",
                    kind_id: ""
                }
            }
        },

        props: ['currentKinds'],

        methods: {
            createSpell() {

                axios.post("/spell/", {
                    name: this.spell.name,
                    quote: this.spell.quote,
                    kind_id: this.optionValue.value,
                    description: this.spell.description

                }, {timeout: 10000 })
                    .then(res => {
                        this.returnMessage = "Spell created successfully";
                        this.returnMessageTheme = "returnMessageSuccess";
                        //console.log(document.getElementById("spellForm"));
                        document.getElementById("spellForm").reset();
                        this.spell.name = "";
                        this.spell.quote = "";
                        this.spell.kind_id = "";
                        this.spell.description = "";

                    })
                    .catch(error => {

                        console.error(error);
                        if(error.response && error.response.data) {
                            if(error.response.data.errors) {
                                if(error.response.data.errors.name) { this.returnMessage = error.response.data.errors.name[0]; }
                                else if(error.response.data.errors.quote) { this.returnMessage = error.response.data.errors.quote[0]; }
                                else if(error.response.data.errors.kind_id) { this.returnMessage = error.response.data.errors.kind_id[0]; }
                                else if(error.response.data.errors.description) { this.returnMessage = error.response.data.errors.description[0]; }
                            }
                            else if(error.response.data.message && error.response.data.message.match(/SQLSTATE\[23000\]/gi)) { this.returnMessage = "Spell with same name already exists"; }
                            else if(error.response.data.message && error.response.data.message !== "") { this.returnMessage = error.response.data.message; }
                            else { this.returnMessage = error; }
                        }
                        else { this.returnMessage = error; }

                        this.returnMessageTheme = "returnMessageFailed";
                    });
            },
            removeMessage() {
                this.returnMessage = ""
                this.returnMessageTheme = "";
            }
        }
    }
</script>

<style scoped>

</style>
