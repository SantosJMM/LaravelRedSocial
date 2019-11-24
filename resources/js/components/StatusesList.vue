<template>
    <div>
        <div v-for="status in statuses" v-text="status.body"></div>
    </div>
</template>

<script>
    export default {
        name: "StatusesList",
        data() {
          return {
              statuses: [],
          }
        },
        mounted() {
            axios.get('/statuses')
                .then(res => {
                    this.statuses = res.data.data
                })
                .catch(err => {
                    console.log(err.response.data);
                });

            EventBus.$on('status-create', status => {
                this.statuses.unshift(status);
            })
        }
    }
</script>

<style scoped>

</style>
