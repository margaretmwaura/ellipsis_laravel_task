<template>
   <button @click="delete_url">Delete</button>
</template>

<script>
import eventBus from "../../eventBus";
import axios from 'axios'
export default {
    name: "DeleteUrl",
    props: {
        rowData: {
            type: Object,
            required: true
        },
        rowIndex: {
            type: Number
        }
    },
    methods: {
        async delete_url(e) {
            alert("Deleting")
            await axios.post('/api/delete_url', {"id": this.rowData.id}
            ).then(
                async ({data}) => {
                    alert("Finished Deleting")
                    if (data.status === 200) {
                        eventBus.$emit("reload-table");
                    }
                }).catch(({}) => {
            })
        },
    },
}
</script>

<style scoped>

</style>
