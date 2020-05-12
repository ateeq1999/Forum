import './bootstrap';

Vue.component('alert', require('./components/AlertComponent.vue').default);
Vue.component('thread-view', require('./pages/Thread.vue').default);
Vue.component('user-notifications', require('./components/UserNotifications').default)
Vue.component('avatar-form', require('./components/AvatarForm').default)

const app = new Vue({
    el: '#app',
});

require('./navbar')
