import Vue from 'vue';

//videoChat Components
Vue.component('chat-room',require('./VideoChat/ChatRoomComponent.vue').default);

Vue.component('VideoChat',require('./VideoChat/VideoChatComponent.vue').default);
Vue.component('MessageLog',require('./VideoChat/MessageLogComponent.vue').default);
