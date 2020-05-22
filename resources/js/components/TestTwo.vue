<template>
    <div>
        <p>TestTwo Server status: {{ status }}</p>
        <button @click="changeTestTwoStatus">Change Status</button>
        <p>Some other text</p>
    </div>
</template>

<script>
    export default {
        name: "TestTwo",
        data: function() {
            return {

                status: 'fluffy'
            }
        },
        methods: {
            changeTestTwoStatus() {
                if(this.status === 'fluffy') { this.status = 'soft'; } else { this.status = 'fluffy'; }
            }
        }
    }
</script>

<style scoped>

</style>
