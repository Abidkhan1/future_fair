<template>
  <div>
    <div class="container-fluid mt-5">
      <div class="alert alert-danger row px-5" role="alert"
        v-if="message">
        <div class="col-md-8 mt-5">
          <h4 class="alert-heading">{{title}}</h4>
          <p>{{message}}</p>
        </div>
        <div class="col-md-2 mt-5">
          <button type="button" class="close" aria-label="Close" @click="closeMessage">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>
    </div>


  </div>
</template>

<script>
import Swal from 'sweetalert2'
export default {

  props:[],
  name: "realtime-notification",
  data(){
    return {
      errors : [],
      userId : USER_ID,
      title: 'Hello Test message',
      message: 'Hello Test message',
    }
  },
  mounted(){
    console.log('notification component',this.userId.id);
    Echo.channel('events')
        .listen('RealTimeMessage', (e) =>{
          this.title = e.title;
          this.message = e.message; console.log('RealTimeMessage: Title ', e.title);
          console.log('RealTimeMessage: Message ', e.message);
        });
    // Echo.private('App.User'+this.userId.id)
    // .notification((notification) => {
    //     console.log('new notification',notification.type);
    // });
    // Echo.private('users.' + this.userId.id)
    // .notification((notification) => {
    //     console.log(notification.type);
    // });
  },//mounted

  methods:{
    newMessage(message){
      this.message = message;
    },
    closeMessage(){
      this.message = '';
    },
  },
}
</script>

<style lang="css" scoped>
.profile_data > title {
  padding-top: 10px;
}
</style>
