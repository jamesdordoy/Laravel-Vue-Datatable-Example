require('./bootstrap');

window.Vue = require('vue');

import DataTable from 'laravel-vue-datatable';
Vue.use(DataTable);

Vue.component('user-datatable', require('./components/UserDatatable.vue').default);

const app = new Vue({
    el: '#app',
});
