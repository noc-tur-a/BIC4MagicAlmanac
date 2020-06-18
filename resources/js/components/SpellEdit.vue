
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
                spell: new Form({
                    kind_id: this.currentSpell.kind_id,
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
                console.log("Hello dis is inside editSpell()");
                console.log("name: " + this.spell.name);
                console.log("kind id: " + this.currentSpell.kind_id);
                console.log("id " + this.currentSpell.id);
                console.log("slug " + this.currentSpell.slug);
                console.log("name " + this.currentSpell.name);
                console.log(this.currentSpell.quote);
                console.log(this.currentSpell.description);
                console.log(this.currentSpell.updated_at);
                console.log(this.currentSpell.created_at);

                this.returnMessageTheme = "";
                //TODO check error handling
                this.spell.put(`/spell/${this.spell.slug}`)
                    .then(res => {
                        if (res === 1) {
                            this.returnMessage = res.message;
                            this.returnMessageTheme = "returnMessageSuccess";
                            window.location.href = "/spell?success";
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
