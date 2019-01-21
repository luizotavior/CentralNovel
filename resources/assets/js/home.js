import Vue from 'vue'
import _ from 'lodash'
import VueResource from 'vue-resource'
import adblock from 'vue-adblock'
import CentralFeed from './components/feed.vue'

Vue.use(VueResource);


new Vue({
    el: '#app-vue',

    components: {
        adblock,
    },

    data: {
        add: null,
    }
})

new Vue({
    el: 'div.table-responsive',

    components: {
        CentralFeed,
    },

    data: {}
})