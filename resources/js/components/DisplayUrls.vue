<template>
    <div class="grid-x notes">
        <vuetable ref="vuetable"
                  :data="all_urls"
                  :css="css.table"
                  :fields="fields"
                  :api-mode="false"
                  pagination-path=""
                  noDataTemplate="No urls added">
        </vuetable>
    </div>

</template>


<script>
import Vuetable from './../../../node_modules/vuetable-2/src/components/Vuetable'
import CssConfig from "../VuetableConfig";

import axios from 'axios'
import eventBus from "../eventBus";
export default {
    components: {
        Vuetable,
    },
    data() {
        return {
            css: CssConfig,
            all_urls: [],
            fields : [
                {
                    name: '__component:delete-url',
                    // name: '__slot:details',
                    title: 'Delete',
                    width: '75%',
                },
                {
                    title: 'Original Url',
                    name: 'original_url',
                },
                {
                    title: 'Shortened Url',
                    name: 'shortened_url',
                },
            ]
        }
    },
    methods: {
        async getAllUrls() {
            await axios.get('/api/urls',).then(({data}) => {
                if (data.status === 200) {
                    this.all_urls = data.data
                    console.log(this.all_urls)
                }
            }).catch(({response: {data}}) => {
            })
        }
    },
    mounted() {
        this.getAllUrls()
        eventBus.$on('reload-table', () => {
            this.getAllUrls()
        })
    },
}
</script>

