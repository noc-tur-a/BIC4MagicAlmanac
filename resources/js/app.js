/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import vue from 'vue';
//use the moment Javascript Library
vue.use(require('vue-moment'));
window.Vue = vue;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('query-message', require('./components/base/QueryMessage.vue').default);

Vue.component('kind-list', require('./components/KindList.vue').default);
//Vue.component('kind-list', require('./components/KindList2.vue').default);

//Vue.component('kind-edit', require('./components/KindEdit_tobedeleted.vue').default);
Vue.component('kind-edit', require('./components/KindEdit.vue').default);
Vue.component('kind-create', require('./components/KindCreate.vue').default);
Vue.component('kind-show', require('./components/KindShow.vue').default);

Vue.component('spell-list', require('./components/SpellList.vue').default);
Vue.component('spell-create', require('./components/SpellCreate.vue').default);
//Vue.component('spell-create', require('./components/SpellCreateWithForms.vue').default);
Vue.component('spell-search', require('./components/SpellSearch.vue').default);
Vue.component('spell-show', require('./components/SpellShow.vue').default);
Vue.component('spell-edit', require('./components/SpellEdit.vue').default);

Vue.component('test', require('./components/test.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
