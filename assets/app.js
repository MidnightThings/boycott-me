import './less/global.less';
import './js/libraries.js'

import Vue from 'vue';
import Login from '../vue-templates/Login.vue';
import idx from '../vue-templates/Index.vue';

$(document).ready(function() {
    /**
    *Create a fresh Vue Application instance
    */
    new Vue({
        el: '#app',
        components: {Login, idx}
      });
    });

