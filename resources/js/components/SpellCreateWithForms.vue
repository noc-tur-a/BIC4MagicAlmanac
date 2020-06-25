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
                spell: new Form({
                    name: "",
                    quote: "",
                    description: "",
                    kind_id: ""
                }),
            }
        },
        props: ['currentKinds'],
        methods: {
            createSpell() {
                this.spell.kind_id = this.optionValue.value;
                this.spell.post("/spell/")
                    .then(res => {
                        this.returnMessage = "Spell erfolgreich erstellt!";
                        this.returnMessageTheme = "returnMessageSuccess";
                        document.getElementById("spellForm").reset();
                    })
                    .catch(error => {
                        if(error) {
                            if(error.name) { this.returnMessage = error.name[0]; }
                            else if(error.quote) { this.returnMessage= error.quote[0]; }
                            else if(error.kind_id) { this.returnMessage= error.kind_id[0]; }
                            else if(error.description) { this.returnMessage= error.description[0]; }
                        } else {
                            this.returnMessage = "Unexpected Error: Spell with same name may already exist";
                        }
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
