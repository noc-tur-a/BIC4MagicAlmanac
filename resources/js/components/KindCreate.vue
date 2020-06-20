<template>
        <div>
            <h1>Create Kind</h1>

                <form id="kindForm" @submit.prevent>

                    <label for="name">Name:</label>
                    <input required="required" type="text" id="name" name="name" class="inputText"
                           v-model.trim="kind.name"  @focus.stop="removeMessage" @keypress.stop="removeMessage">
                    <br>

                    <label for="description" class="labelTextArea">Description:</label>
                    <textarea required="required" id="description" name="description" class="inputTextarea"
                              v-model.trim="kind.description" @focus.stop="removeMessage" @keypress.stop="removeMessage"></textarea>
                    <br>

                    <input type="submit" name="submit" value="Create" class="submit" @click="createKind()">
                    <span style="white-space: nowrap;" class="returnMessage" :class="returnMessageTheme">{{ returnMessage }}</span>
                </form>


        </div>

</template>

<script>
    export default {
        //name: "test",
        data: function() {
            return {
                returnMessage: "",
                returnMessageTheme: "",
                kind: {
                    name: "",
                    description: ""
                }
            }
        },
        methods: {

            createKind() {
                axios.post("/kind/", {
                    name: this.kind.name,
                    description: this.kind.description

                }, {timeout: 10000 })
                    .then(res => {
                        this.returnMessage = "Kind created successfully";
                        this.returnMessageTheme = "returnMessageSuccess";
                        //console.log(document.getElementById("spellForm"));
                        document.getElementById("kindForm").reset();
                        this.kind.name = "";
                        this.kind.description = "";

                    })
                    .catch(error => {
                        console.error(error);
                        if(error.response && error.response.data) {
                            if(error.response.data.errors) {
                                if(error.response.data.errors.name) { this.returnMessage = error.response.data.errors.name[0]; }
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
