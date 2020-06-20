
<script src="../utilities/Form.js"></script>
<template>
    <div>
        <h1>Edit Spell</h1>
        <template>
            <form @submit.prevent>
                <input type="hidden" name="id" v-model="spell.id">
                <input type = "hidden" name="slug" v-model="spell.slug">
                <input type = "hidden" name="kind_id" v-model="spell.kind_id">

                <label>Updated:</label>
                <span class="inputText">{{ spell.updated_at | moment("DD.MM.YYYY - HH:mm:ss") }}</span>
                <br>

                <label>Created:</label>
                <span class="inputText">{{ spell.created_at | moment("DD.MM.YYYY - HH:mm:ss") }}</span>
                <br>

                <label for="name">Name:</label>
                <input type="text" id="name" name="name" v-model="spell.name" class="inputText">
                <br>

                <label for="quote" class="labelTextArea">Quote:</label>
                <textarea id="quote" name="quote" v-model="spell.quote" class="inputTextarea"></textarea>
                <br>

                <label for="description" class="labelTextArea">Description:</label>
                <textarea id="description" name="description" v-model="spell.description" class="inputTextarea"></textarea>
                <br>

                <input type="hidden" name="created_at" v-model="spell.created_at">
                <input type="hidden" name="updated_at" v-model="spell.updated_at">

                <input type="submit" name="submit" value="Update" class="submit" @click="editSpell()">
                <span class="returnMessage" :class="returnMessageTheme">{{ returnMessage }}</span>

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
                spell:{
                    kind_id: this.currentSpell.kind_id,
                    id: this.currentSpell.id,
                    slug: this.currentSpell.slug,
                    name: this.currentSpell.name,
                    quote: this.currentSpell.quote,
                    description: this.currentSpell.description,
                    updated_at: this.currentSpell.updated_at,
                    created_at: this.currentSpell.created_at
                },
            }
        },
        props: ['currentSpell'],

        methods: {
            editSpell() {
                this.returnMessageTheme = "";
                axios.put(`/spell/${this.spell.slug}`, {
                    name: this.spell.name,
                    quote: this.spell.quote,
                    description: this.spell.description,
                    kind_id: this.spell.kind_id

                }, {timeout: 10000}, )
                    .then(res => {
                        if (res.data.message === "Spell successfully update!") {
                            console.log("Log from line 77");
                            this.returnMessage = res.data.message;
                            this.returnMessageTheme = "returnMessageSuccess";
                            window.location.href = "/spell?success";
                        } else {
                            this.returnMessage = res.message;
                            this.returnMessageTheme = "returnMessageFailed";
                        }
                    })

                    .catch(error => {

                        console.error(error);
                        if(error.response && error.response.data) {
                            if(error.response.data.errors) {
                                if(error.response.data.errors.name) {
                                    this.returnMessage = error.response.data.errors.name[0];
                                }
                                else if(error.response.data.errors.description) {
                                    this.returnMessage = error.response.data.errors.description[0];
                                }
                            }
                            else if(error.response.data.message && error.response.data.message.match(/SQLSTATE\[23000\]/gi)) {
                                this.returnMessage = "Spell with same name already exists";
                            }
                            else if(error.response.data.message && error.response.data.message !== "") {
                                this.returnMessage = error.response.data.message;
                            }
                            else {
                                this.returnMessage = error;
                            }
                        }
                        else {
                            this.returnMessage = error;
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
