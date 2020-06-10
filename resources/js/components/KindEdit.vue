
<script src="../utilities/Form.js"></script>
<template>
    <div>
        <h1>Edit Kind</h1>
        <template>
            <form @submit.prevent>
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
                currentSlug: "",
                link: '/list/kind',
                returnMessage: "",
                returnMessageTheme: "",
                kind: new Form({
                        id: "",
                        slug: "",
                        name: "",
                        description: "",
                        updated_at: "",
                        created_at: ""
                }),
                kinds: []
            }
        },
        created: function(){
            this.currentSlug = window.location.pathname.split('/kind/').pop().split('/edit')[0];
            console.log(this.currentSlug);

            this.fetchKinds(this.link);

        },
        methods: {
            prepareSlugName(str) {
              return str.trim()
                  .replace(/[- ]{2,}/, "-")
                  .replace(/[^a-zA-Z- ]/mg, "")
                  .replace(/^[- ]+/mg, "")
                  .replace(/[- ]+$/mg, "")
                  .trim()
                  .replace(/ /mg, "-")
                  .toLowerCase();
              //return str;
            },
            editKind() {
                this.currentSlug = this.prepareSlugName(this.kind.name);
                this.kind.put(`/kind/${this.kind.slug}`)
                .then(res => {
                    if(res === 1) {
                        this.returnMessageTheme = "returnMessageSuccess";
                        this.returnMessage = "Update erfolgreich";
                    } else {
                        this.returnMessageTheme = "returnMessageFailed";
                        this.returnMessage = "Update fehlgeschlagen";
                    }
                    this.fetchKinds(this.link);
                });
            },
            fetchKinds(link) {
                fetch(link)
                .then(res => res.json())
                .then(res => {
                    this.kinds = res;
                    for(let i = 0; i < this.kinds.length; i++) {
                        if(this.kinds[i].slug === this.currentSlug) {
                            this.kind.id = this.kinds[i].id;
                            this.kind.slug = this.kinds[i].slug;
                            this.kind.name = this.kinds[i].name;
                            this.kind.description = this.kinds[i].description;
                            this.kind.created_at = this.kinds[i].created_at;
                            this.kind.updated_at = this.kinds[i].updated_at;
                        }
                    }
                    });
            }
        }
    }
</script>

<style scoped>

</style>
