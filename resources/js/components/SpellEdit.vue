
<script src="../utilities/Form.js"></script>
<template>
    <div>
        <h1>Edit Spell</h1>
        <template>
            <form @submit.prevent>
                <input type="hidden" name="id" v-model="spell.id">
                <input type = "hidden" name="slug" v-model="spell.slug">

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
                spell: new Form({
                    id: this.currentSpell.id,
                    slug: this.currentSpell.slug,
                    name: this.currentSpell.name,
                    quote: this.currentSpell.quote,
                    description: this.currentSpell.description,
                    updated_at: this.currentSpell.updated_at,
                    created_at: this.currentSpell.created_at
                }),
            }
        },
        props: ['currentSpell'],

        methods: {
            editSpell() {
                this.returnMessageTheme = "";
                this.spell.put(`/spell/${this.spell.slug}`)
                    .then(res => {
                        if (res.message === "Spell successfully updated!") {
                            this.returnMessage = res.message;
                            this.returnMessageTheme = "returnMessageSuccess";
                            window.localStorage.href = "/spell?success";
                        } else {
                            this.returnMessage = res.message;
                            this.returnMessageTheme = "returnMessageFailed";
                        }
                    })

                    .catch(error => {
                        this.returnMessage = error.name[0];
                        this.returnMessageTheme = "returnMessageFailed";
                    });
            },
        }
    }
</script>

<style scoped>

</style>
