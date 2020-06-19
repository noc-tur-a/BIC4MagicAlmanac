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
                kind: new Form({
                    name: "",
                    description: ""
                }),


            }
        },
        methods: {

            createKind() {
                this.kind.post("/kind/")
                    .then(res => {
                        this.returnMessage = "Kind successfully created";
                        this.returnMessageTheme = "returnMessageSuccess";
                        //this.kind.reset();
                        //we use build in javascipt method to reset the form because the provided reset function
                        //from Form.js doesn't handle the required="required" correctly
                        document.getElementById("kindForm").reset();

                    })
                    .catch(error => {
                        if(error) {
                            if(error.name) { this.returnMessage = error.name[0]; }
                            if(error.description) { this.returnMessage = error.description[0]; }
                        } else {
                            this.returnMessage = "Unexpected Error: Kind with same name may already exist";
                        }
                        this.returnMessageTheme = "returnMessageFailed";
                        //this.kind.reset();
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
