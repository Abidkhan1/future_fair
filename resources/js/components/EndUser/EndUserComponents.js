import Vue from 'vue';

//dashboard Component
Vue.component('enduser-dashboard',require('./Dashboard/DashboardComponent.vue').default);
Vue.component('events-select',require('./Dashboard/EventsSelectComponent.vue').default);

//NotificationComponent
Vue.component('realtime-notification',require('./Notification/NotificationComponent.vue').default);

//Profile
Vue.component('user-profile',require('./Profile/ProfileComponent.vue').default);

//Pavillion
Vue.component('pavillion',require('./Pavillion/PavillionComponent.vue').default);

//Reception
Vue.component('reception',require('./Reception/ReceptionComponent.vue').default);
Vue.component('chat',require('./Reception/ChatComponent.vue').default);
//
Vue.component('PrivateMessageComponent',require('./Reception/PrivateMessageComponent.vue').default);
Vue.component('end-user-video-chat',require('./Reception/EndUserVideoChatComponent.vue').default);
