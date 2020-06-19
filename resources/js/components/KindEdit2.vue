
<script src="../utilities/Form.js"></script>
<template>
    <div>
        <h1>Edit Kind muhu</h1>
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
                <input type="text" required="required" id="name" name="name" class="inputText"
                       v-model="kind.name" @focus.stop="removeMessage" @keypress.stop="removeMessage" >
                <br>

                <label for="description" class="labelTextArea">Description:</label>
                <textarea required="required" id="description" name="description" class="inputTextarea" v-model="kind.description" @focus.stop="removeMessage" @keypress.stop="removeMessage"></textarea>
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
                kind: {
                    id: this.currentKind.id,
                    slug: this.currentKind.slug,
                    name: this.currentKind.name,
                    description: this.currentKind.description,
                    updated_at: this.currentKind.updated_at,
                    created_at: this.currentKind.created_at
                }
            }
        },
        props: ['currentKind'],
        methods: {

            editKind() {
                //TODO check error handling, i.e. use wrong url, create kind that already exists
                this.returnMessageTheme = "";
                axios.put(`/kind/${this.kind.slug}`, {
                    name: this.kind.name,
                    description: this.kind.description

                }, {timeout: 10000 }, )
                    .then(res => {
                        if(res.data.message === "Kind successfully updated!") {
                            this.returnMessage = res.data.message;
                            this.returnMessageTheme = "returnMessageSuccess";
                            window.location.href = "/kind?success";
                        }

                    })
                    .catch(error => {
                        if(error.response.data.errors) {
                            if(error.response.data.errors.name) { this.returnMessage = error.response.data.errors.name[0];}
                            else if(error.response.data.errors.description) { this.returnMessage = error.response.data.errors.description[0]; }
                        }
                        else if(error.response.data.message && error.response.data.message.match(/SQLSTATE\[23000\]/gi)) { this.returnMessage = "Kind with same name already exists"; }
                        else if(error.response.data.message && error.response.data.message !== "") { this.returnMessage = error.response.data.message; }
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
