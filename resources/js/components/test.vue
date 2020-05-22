<template>
    <div>
        <p>Server status: {{ status }}</p>
        <button @click="changeStatus">Change Status</button>
        <p>Some text</p>
    </div>
</template>

<script>
    export default {
        name: "test",
        data: function() {
            return {

                status: 'Critical'
            }
        },
        methods: {
            changeStatus() {
                if(this.status === 'Critical') { this.status = 'Normal'; } else { this.status = 'Critical'; }
            }
        }
    }
</script>

<style scoped>

</style>
