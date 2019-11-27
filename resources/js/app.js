require('./bootstrap');

window.Vue = require('vue');
window.EventBus = new Vue();

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('status-form', require('./components/StatusForm.vue').default);
Vue.component('status-list', require('./components/StatusList.vue').default);
Vue.component('friendship-btn', require('./components/FriendshipBtn.vue').default);
Vue.component('accept-friendship-btn', require('./components/AcceptFriendshipBtn').default);

import auth from './mixins/auth';

Vue.mixin(auth);

const app = new Vue({
    el: '#app',
});
