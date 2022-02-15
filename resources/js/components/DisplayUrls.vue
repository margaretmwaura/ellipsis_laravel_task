<template>
    <div class="grid-x notes">
        <vuetable ref="vuetable"
                  :data="all_urls"
                  :css="css.table"
                  :fields="['original_url', 'shortened_url']"
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

export default {
    components: {
        Vuetable,
    },
    data() {
        return {
            css: CssConfig,
            all_urls: [],
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
    },
}
</script>

