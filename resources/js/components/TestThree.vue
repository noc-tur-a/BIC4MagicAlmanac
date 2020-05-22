<template>
    <div>
        <p>TestThree Server status: {{ status }}</p>
        <button @click="changeTestThreeStatus">Change Status</button>
        <p>Some other text</p>
    </div>
</template>

<script>
    export default {
        name: "TestThree",
        data: function() {
            return {

                status: 'fluffy'
            }
        },
        methods: {
            changeTestThreeStatus() {
                if(this.status === 'fluffy') { this.status = 'soft'; } else { this.status = 'fluffy'; }
            }
        }
    }
</script>

<style scoped>

</style>
