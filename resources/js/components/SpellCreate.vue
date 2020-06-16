<template>
    <div>
        <h1>Create spell</h1>
        <template>
            <form id="kindForm" @submit.prevent>

                <label for="name">Name:</label>
                <input type="text" id="name" name="name" v-model="spell.name" class="inputText">
                <br>
                <label for="quote" class="labelTextArea">Quote:</label>
                <input id="quote" name="quote" v-model="spell.quote" class="inputText">
                <br>
                <label for="kindId" class="labelTextArea">Kind Id:</label>
                <input id="kindId" name="kindId" v-model="spell.kind_id" class="inputText">
                <br>
                <label for="description" class="labelTextArea">Description:</label>
                <textarea id="description" name="description" v-model="spell.description" class="inputTextarea"></textarea>
                <br>

                <input type="submit" name="submit" value="Create" class="submit" @click="createSpell()">
                <span class="returnMessage"  :class="returnMessageTheme">{{ returnMessage }}</span>

            </form>

           <!-- <template v-for="currentKind in currentKinds">
                <p>{{ currentKind.name }}</p>
            </template>-->
        </template>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                returnMessage: "",
                returnMessageTheme: "",
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
