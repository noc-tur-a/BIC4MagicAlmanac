<template>
    <div class="ma-content">
        <h1>List of kinds</h1>

        <template v-for="currentKind in currentKinds">
            <p>{{ currentKind.name }}</p>

        </template>

    </div>
</template>

<script>

    export default {
        data() {
            return {
                //kinds: [],
                //link: "kind/" + this.kind.slug + "/edit",
                kindLink: "kind/",
                editLink: "/edit",
                isActive: false
            }
        },

        props: ['currentKinds'],

        created() {

            console.log("this.kinds :" + this.kinds);
            console.log(this.currentKinds);

            /*//TODO Maybe use the fetch method?
            axios.get('/list/kind')
                .then(response => {
                    this.kinds = response.data
                })
                .catch(error => {
                    console.log(error);
                })*/
        },
        methods: {
            showSpells(e) {

                var elementRow = e.target.parentNode.nextElementSibling
                var elementRowParent = e.target.parentNode;

                if(!elementRow.classList.contains("maTableOuterRowHidden")) { return }

                if(elementRow.classList.contains("maTableOuterRowShow")) {
                    elementRow.classList.remove("maTableOuterRowShow");
                    elementRowParent.classList.remove("maTableOuterRowParentShow");
                } else {
                    elementRow.classList.add("maTableOuterRowShow");
                    elementRowParent.classList.add("maTableOuterRowParentShow");
                }

            } //END showSpells
        } //END Methods
    } //End export default

</script>

<style scoped>

</style>
