
<script src="../utilities/Form.js"></script>
<template>
    <div>
        <h1>Edit Kind</h1>
        <template>
            <form  @submit.prevent>
                <input type="hidden" name="id" v-model="kind.id">

                <input type="hidden" name="slug" v-model="kind.slug">
                <label>Updated:</label>
                <span class="inputText">{{ kind.updated_at | moment("DD.MM.YYYY - HH:mm:ss") }}</span>
                <br>
                <label>Created:</label>
                <span class="inputText">{{ kind.created_at | moment("DD.MM.YYYY - hh:mm:ss") }}</span>
                <br>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" v-model="kind.name" class="inputText">
                <br>

                <label for="description" class="labelTextArea">Description:</label>
                <textarea id="description" name="description" v-model="kind.description" class="inputTextarea"></textarea>
                <br>

                <input type="hidden" name="created_at" v-model="kind.created_at">
                <input type="hidden" name="updated_at" v-model="kind.updated_at">

                <input type="submit" name="submit" value="Update" class="submit" @click="editKind()">
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
                kind: new Form({
                        id: this.currentKind.id,
                        slug: this.currentKind.slug,
                        name: this.currentKind.name,
                        description: this.currentKind.description,
                        updated_at: this.currentKind.updated_at,
                        created_at: this.currentKind.created_at
                }),
            }
        },
        props: ['currentKind'],
        methods: {
            editKind() {
                //TODO check error handling, i.e. use wrong url, create kind that already exists
                this.returnMessageTheme = "";
                this.kind.put(`/kind/${this.kind.slug}`)
                .then(res => {
                    if(res.message === "Kind successfully updated!") {
                        this.returnMessage = res.message;
                        this.returnMessageTheme = "returnMessageSuccess";
                        window.location.href = "/kind?success";
                    }
                    else {
                        this.returnMessage = res.message;
                        this.returnMessageTheme = "returnMessageFailed";
                        console.log("Message: Unexpected Error!");
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
