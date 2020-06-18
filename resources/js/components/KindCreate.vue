<template>
        <div>
            <h1>Create Kind</h1>
            <template>
                <form id="kindForm" @submit.prevent>

                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" v-model.trim="kind.name" class="inputText">
                    <br>

                    <label for="description" class="labelTextArea">Description:</label>
                    <textarea id="description" name="description" v-model.trim="kind.description" class="inputTextarea"></textarea>
                    <br>

                    <input type="submit" name="submit" value="Create" class="submit" @click="createKind()">
                    <span class="returnMessage"  :class="returnMessageTheme">{{ returnMessage }}</span>

                </form>
            </template>
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
                        this.returnMessage = "Kind erfolgreich erstellt!";
                        this.returnMessageTheme = "returnMessageSuccess";
                    })
                    .catch(error => {
                        this.returnMessage = error.name[0];
                        this.returnMessageTheme = "returnMessageFailed";
                    });
            }
        }
    }
</script>

<style scoped>

</style>
