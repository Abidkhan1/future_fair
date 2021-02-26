<template>
  <div class="chat_popup">
      <div class="chat_popupInner" style="border-radius: 5px; overflow: hidden;">
          <div class="chat_top">
              <h5>
                <span v-if="staffSelected">To: <span class="name1">
                      {{friend.name}} <span v-if="isTyping">is Typing</span>
                   </span>
                </span>
                <span v-else>Chat</span>
             </span>
              </h5>
              <ul>
                  <li v-if="staffSelected">
                      <a  @click="callParent"><img :src="base_url+'future_html/images/chat_popup.png'" alt="icon"></a>
                  </li>
                  <li v-if="staffSelected">
                      <a href="javascript:void(0);" @click="close" ><i class="fas fa-users fa-2x"></i></a>
                  </li>
              </ul>
              <a class="closeChat" href="javascript:void(0);"
                @click="showChat = !showChat">
                <i class="fas"
                :class="(showChat)?'fa-chevron-down':'fa-chevron-up'"></i>
              </a>
          </div>

          <div v-if="showChat">

          <div class="chat1" style=" background-color: #a6b7bd; opacity: 0.9; height: 300px; overflow-y: scroll;" v-chat-scroll  >
            <template v-if="!staffSelected">
              <div class="card-text">
                <ul class="people1">
                    <li class="person1 mt-2"    @click.prevent="openChat(friend)"  v-for="friend in friends" :key="friend.id">
                        <img :src="base_url+'public/AdminLTE/dist/img/avatar5.png'" alt="" class="img-thumbnail"
                        width="50px" height="50px"/>
                        <span class="name1"> {{friend.name}}</span>
                        <span class="time search1" style="  padding: 5px; background: #00b0ff; border: 2px solid #00b0ff; color: #effbff; text-align: center;font-size: 16px" v-if="friend.session && friend.session.unreadCount > 0">{{friend.session.unreadCount}}</span>

                        <span  class="badge badge-success" v-if="friend.online" >Online</span>
                        <span class="badge badge-danger" v-else>Offline</span>
                    </li>
                </ul>
                <!-- <ul>
                  <li v-for="(staff,i) in staffs" :key='i'>{{staff.name}}</li>
                </ul> -->
              </div>
            </template>
            <template v-else>
              <div   class="card-text" v-chat-scroll>
                 <p  :class="{'bubble you':chat.type === 0,'bubble me':chat.type === 1}" v-for="chat in chats" :key="chat.id">
                    {{chat.message}}
                    <br>
                    <span style="font-size:10px">{{chat.send_at}}</span>

                    <br>
                    <i v-if="chat.read_at!=null" class="fa fa-check" style=" color: #fff9fe" aria-hidden="true">
                       <span style="font-size:10px">read {{chat.read_at}}</span>
                    </i>
                 </p>
              </div>
            </template>


             </div>
          <div class="type_msg" style="opacity: 0.9;" v-if="staffSelected">
            <form class="card-footer1"  @submit.prevent="send">
              <input type="text" style="width: 240px; overflow: scroll;" placeholder="Write your message here"

              v-model="message" />
              <a type="submit" style="cursor: pointer; position: absolute; margin-left: 10px; margin-top: 10px;" @click.prevent="send" class="write-link send"><i class="fa fa-paper-plane" aria-hidden="true"></i></a>
            </form>
          </div>

        </div>
      </div>
  </div>
</template>

<script>
export default {
   props: ['company'],
   data() {
      return {
         chats: [],
         staffs: [],
         friend: '',
         friends: [],
         message: null,
         staffSelected: false,
         isTyping: false,
         username: "",
         room_name: "",
         showChat: true,
         get_access: false,
         base_url: APP_URL
      }
   },
   watch: {
      message(value) {
         if (value) {
            Echo.private(`Chat.${this.friend.session.id}`).whisper("typing", {
               name: auth.name
            });
         }
      }
   },
   computed: {
      session() {
         return this.friend.session;
      },
      can() {
         return this.session.blocked_by == auth.id;
      }
   },

   created(){ },

   mounted(){
  console.log('friend',this.friend);
  axios.get(APP_URL+`company_staffs/${this.company.id}`)
  .then(res=>{
    this.friends = res.data.data;
    this.friends.forEach(
        friend => (friend.session ? this.listenForEverySession(friend) : "")
    );
  })
  .catch(error=>{
    console.log("error",error);
  })
},
methods: {
  createChat(){

         // New code
         Echo.channel("Chat").listen("SessionEvent", e => {
             let friend = this.friend;
             friend.session = e.session;
             this.listenForEverySession(friend);
         });
         Echo.join(`Chat`)
             .here((users) => {
               this.friend.online = true;
                 this.friends.forEach(friend => {
                     users.forEach(user => {
                         if (user.id == friend.id) {
                             friend.online = true;
                         }
                     });
                 });
             })
             .joining(user => {
                 this.friends.forEach(
                     friend => (user.id == friend.id ? (friend.online = true) : "")
                 );
             })
             .leaving(user => {
                 this.friends.forEach(
                     friend => (user.id == friend.id ? (friend.online = false) : "")
                 );
             });
         // New code
          this.read();
          this.getAllMessages();
          Echo.private(`Chat.${this.friend.session.id}`).listen(
             "PrivateChatEvent",
             e => {
                this.friend.session.open ? this.read() : "";
                this.chats.push({ message: e.content, type: 1, send_at: "Just Now" });
             }
          );
          Echo.private(`Chat.${this.friend.session.id}`).listen("MsgReadEvent", e =>
          this.chats.forEach(
             chat => (chat.id == e.chat.id ? (chat.read_at = e.chat.read_at) : "")
          )
       );
       Echo.private(`Chat.${this.friend.session.id}`).listen(
          "BlockEvent",
          e => (this.session.block = e.blocked)
       );
       Echo.private(`Chat.${this.friend.session.id}`).listenForWhisper(
          "typing",
          e => {
             this.isTyping = true;
             setTimeout(() => {
                this.isTyping = false;
             }, 2000);
          }
       );
  }, //createChat

  callParent() {
    const my_Id = window.auth.id;
    const friend_Id = this.friend.id;
    this.username = window.auth.name;

    if (my_Id > friend_Id) {
       this.room_name = friend_Id+'_'+my_Id
    }else {
       this.room_name = my_Id+'_'+friend_Id
    }
    this.get_access = true;
    let _self = this
    this.$nextTick(()=>{
      _self.$emit('onChange', 'hi from child',_self.room_name,_self.username);
    })

    },
   videoCall() {

      const my_Id = window.auth.id;
      const friend_Id = this.friend.id;
      this.username = window.auth.name;

      if (my_Id > friend_Id) {
         this.room_name = friend_Id+'_'+my_Id
      }else {
         this.room_name = my_Id+'_'+friend_Id
      }
      this.get_access = true;
   },
   getAllMessages() {
      axios
      .post(this.base_url+`session/${this.friend.session.id}/chats`)
      .then(res => (this.chats = res.data.data));
   },
   send() {
      if (this.message) {
         this.pushToChats(this.message);
         axios
         .post(this.base_url+`send/${this.friend.session.id}`, {
            message: this.message,
            to_user: this.friend.id
         })
         .then(res => (this.chats[this.chats.length - 1].id = res.data));
         this.message = null;
      }
   },
   pushToChats(message) {
      this.chats.push({
         message: message,
         type: 0,
         read_at: null,
         send_at: "Just now"
      });
   },
   close() {
       this.friend.session.open = false;
       this.staffSelected = false
   },
   clear() {
      axios.post(this.base_url+`session/${this.friend.session.id}/clear`).then(res => {
         this.chats = [];
      })
   },
   block() {
      this.session.block = true;
      axios
      .post(this.base_url+`session/${this.friend.session.id}/block`)
      .then(res => (this.session.blocked_by = auth.id));
   },
   unblock() {
      this.session.block = false;
      axios.post(this.base_url+`session/${this.friend.session.id}/unblock`).then(
         res => {
            this.session.blocked_by = null;
         }
      );
   },
   read() {
      axios.post(this.base_url+`session/${this.friend.session.id}/read`);
   },
   openChat(friend) {
     console.log('friend',friend);
     this.friend = friend;
     this.createChat();
     this.staffSelected = true
       if (this.friend.session) {
           this.friend.session.open = true;
           this.friend.session.unreadCount = 0;
       } else {
           this.createSession(friend);
       }
   },
   createSession(friend) {
       axios.post(this.base_url+"session/create", { friend_id: friend.id }).then(res => {
           (friend.session = res.data.data), (friend.session.open = true);
       });
   },
   listenForEverySession(friend) {
       Echo.private(`Chat.${friend.session.id}`).listen(
           "PrivateChatEvent",
           e => (friend.session.open ? "" : friend.session.unreadCount++)
       );
   }
},
};
</script>
<style lang="css" scoped>
</style>
