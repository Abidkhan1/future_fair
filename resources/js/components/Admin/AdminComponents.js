import Vue from 'vue';

//Company Components
Vue.component('add-company',require('./Company/AddCompanyComponent.vue').default);
Vue.component('edit-company',require('./Company/EditCompanyComponent.vue').default);
Vue.component('register-event',require('./Company/RegisterEventComponent.vue').default);

//Event Components
Vue.component('add-event',require('./Event/AddEventComponent.vue').default);
Vue.component('edit-event',require('./Event/EditEventComponent.vue').default);

//Pavillion Components
Vue.component('add-pavillion',require('./Pavillion/AddPavillionComponent.vue').default);
Vue.component('edit-pavillion',require('./Pavillion/EditPavillionComponent.vue').default);

// End user setting components
Vue.component('enduser-settings',require('./Setting/UserDashboardSettingComponent.vue').default);

// End user setting components
Vue.component('notifications',require('./Notification/NotificationComponent.vue').default);
