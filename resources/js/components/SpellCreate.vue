<template>
    <div>
        <h1>Create spell</h1>
        <template>
            <form id="kindForm" @submit.prevent>

                <label for="name">Name:</label>
                <input type="text" id="name" name="name" v-model.trim="spell.name" class="inputText">
                <br>
                <label for="quote" class="labelTextArea">Quote:</label>
                <input id="quote" name="quote" v-model.trim="spell.quote" class="inputText">
                <br>
                <label for="kindId" class="labelTextArea">Kind Id:</label>
                <select id="kindId" v-model="optionValue">
                    <template v-for="currentKind in currentKinds">
                        <option v-bind:value="{ value: currentKind.id }" >{{ currentKind.name }}</option>
                    </template>
                </select>
                <span>Selected: {{ optionValue.value }}</span>
                <br>
                <label for="description" class="labelTextArea">Description:</label>
                <textarea id="description" name="description" v-model.trim="spell.description" class="inputTextarea"></textarea>
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

        created() {

        },
        methods: {
            createSpell() {
                this.spell.kind_id = this.optionValue.value;
                console.log(this.spell.name);
                console.log(this.spell.quote);
                console.log(this.spell.description);
                console.log(this.spell.kind_id);
                this.spell.post("/spell/")
                    .then(res => {
                        this.returnMessage = "Spell erfolgreich erstellt!";
                        this.returnMessageTheme = "returnMessageSuccess";
                    })
                    .catch(error => {
                        if(error !== undefined) {
                            this.returnMessage = error.kind_id[0];
                            this.returnMessageTheme = "returnMessageFailed";
                        } else {
                            this.returnMessage = "Unexpected Error";
                            this.returnMessageTheme = "returnMessageFailed";
                        }
                        //console.log("Message: " + message);
                    });
            }
        }
    }
</script>

<style scoped>

</style>
