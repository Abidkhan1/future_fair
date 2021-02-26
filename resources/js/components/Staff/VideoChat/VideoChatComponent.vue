<template>

  <div class="">


    <div class="container">
      <div class="row" style="margin-left: 10px; margin-top: 100px;  width:400px; height:300px;">

      <div  id="client-video-chat-window" style=" background-color: #dce4e6; border-radius: 100px; box-shadow: 0px 0px 15px gray; overflow: hidden; position: absolute; width:400px; height:300px; background-image: url(/expo/AdminLTE/dist/img/vd.png); background-size:100% 100%;">
      </div>
        <div  id="my-video-chat-window" style=" background-color: #dce4e6; border-radius: 25px; overflow: hidden;  box-shadow: 0px 0px 8px gray; position: absolute; margin-left: 300px; margin-top: 225px; width: 100px; height: 75px; background-image: url(/expo/AdminLTE/dist/img/vd.png); background-size:100% 100%;">
        </div>

      </div>
        <!-- <div class="grid grid-flow-row grid-cols-2 grid-rows-1 gap-1 bg-black/]">
            <div id="my-video-chat-window"></div>
        </div> -->
    </div>
    <div class="Video" style="margin-left:68px; margin-top:20px;">
        <button type="submit"
         size="sm"
        style="top: 5px,
        left: 5px"
        @click="showRoom(room_name)"
        class="btn btn-success mb-2 Botton"><a style="color:white;">CONNECT</a></button>
      <button
        v-if="this.microphone == true"
        variant="primary"
        size="sm"
        class="border-0"
        style="top: 5px,
        left: 5px"
        @click="mute_audio"
        ><i class="fa fa-microphone"></i
      ></button>
      <button
        v-if="this.microphone == false"
        variant="primary"
        size="sm"
        class="border-0"
        style="top: 5px,
        left: 5px"
        @click="unmute_audio"
        >
        <i class="fas fa-microphone-slash"></i
      ></button>
      <button
        v-if="this.camera == true"
        variant="primary"
        size="sm"
        class="border-0"
        style="top: 5px,
        left: 5px"
        @click="mute_video"
        ><i class="fas fa-video"></i
      ></button>
      <button
        v-if="this.camera == false"
        variant="primary"
        size="sm"
        class="border-0"
        style="top: 5px,
        left: 5px"
        @click="unmute_video"
        ><i class="fas fa-video-slash"></i
      ></button>
        <button type="submit"
        size="sm"
        style="top: 5px,
        left: 5px"
       @click="
          leaveRoomIfJoined(activeRoom);
        "
        class="btn btn-danger mb-2 Botton"><a style="color:white;">LEAVE</a></button>
    </div>
  </div>
</template>

<script>
import { EventBus } from './Event'
import Twilio, { connect, createLocalTracks, createLocalVideoTrack } from 'twilio-video'
import axios from 'axios'
export default {
 name: "VideoChat",
 data() {
   return {
     loading: false,
     data: {},
     localTrack: false,
     remoteTrack: '',
     accessToken: '',
     activeRoom: '',
     previewTracks: '',
     identity: '',
     roomName: null,
     microphone: true,
     camera: true,
     base_url:APP_URL,
   }
 },
 props: ['username', 'room_name'],
 created() {

 },
 methods: {
   //Access token generation using username and room name
   async getAccessToken() {
         return await axios.get(
             APP_URL+`api/access_token?identity=${this.username}&room_name=${this.room_name}`
           );
   },
   //Click connect button
    showRoom(room) {
      this.room_name = room;
      this.createChat(this.room_name);
      window.addEventListener("beforeunload", this.leaveRoomIfJoined);
      this.startDate = new Date();
      console.log("start date", this.startDate);
    },
   // Trigger log events
   dispatchLog(message) {
      EventBus.$emit("new_log", message);
    },
   // Attach the Tracks to the DOM.
   attachTracks(tracks, container) {
      tracks.forEach(function(track) {
        container.appendChild(track.attach());
      });
    },
    // Attach the Participant's Tracks to the DOM.

    attachParticipantTracks(participant, container) {
      let tracks = Array.from(participant.tracks.values());
      this.attachTracks(tracks, container);
    },
   // Detach the Tracks from the DOM.
  detachTracks(tracks) {
      tracks.forEach((track) => {
        track.detach().forEach((detachedElement) => {
          detachedElement.remove();
        });
      });
    },
   // Detach the Participant's Tracks from the DOM.
    detachParticipantTracks(participant) {
      let tracks = Array.from(participant.tracks.values());
      this.detachTracks(tracks);
    },
   // Leave Room.
  leaveRoomIfJoined(activeRoom) {
    console.log('close');
    activeRoom.localParticipant.tracks.forEach(publication => {
        const attachedElements = publication.track.detach();
        attachedElements.forEach(element => element.remove());
      });
      activeRoom.disconnect();
      let url = this.base_url+'chat';
      setTimeout(function(){ window.location.href = url; }, 1500);
    },
    //mute audio of video chat
      mute_audio() {
      this.activeRoom.localParticipant.audioTracks.forEach(publication => {
        publication.track.disable();
      });
      this.microphone = false;
    },
    //unmute audio of video chat
      unmute_audio() {
        this.activeRoom.localParticipant.audioTracks.forEach(publication => {
          publication.track.enable();
        });
      this.microphone = true;
    },
    //mute video
     mute_video() {
       this.activeRoom.localParticipant.videoTracks.forEach(publication => {
         publication.track.disable();
         // publication.track.stop();
         // publication.unpublish();
       });
      this.camera = false;
    },
    //unmute video
      unmute_video() {
        this.activeRoom.localParticipant.videoTracks.forEach(publication => {
          publication.track.enable();
          // publication.track.stop();
          // publication.unpublish();
        });
      this.camera = true;
    },

   // Create a new chat
   createChat(room_name) {
      this.loading = true;
      const VueThis = this;
      this.getAccessToken().then((data) => {
        console.log(data);
        VueThis.roomName = null;
        const token = data.data.token;
        let connectOptions = {
          name: room_name,
          audio: true,
          video: { width: 500 },
        };

        const handleParticipant = participant => {
            console.log('Participant connected', participant);

            let clientvideoChatWindow = document.getElementById('client-video-chat-window');

            // Attach participants when they join
            participant.on('trackSubscribed', track => {
                console.log('Track subscribed', track);
                clientvideoChatWindow.appendChild(track.attach());
            });

            // Detach participants when they leave
            participant.on('trackUnsubscribed', track => {
                console.log('Track unsubscribed', track);
                track.detach().forEach(mediaElement => {
                    mediaElement.remove();
                });
            });
        }

        Twilio.connect(token, connectOptions).then(function(room) {
          VueThis.activeRoom = room;
          VueThis.roomName = room_name;
          VueThis.loading = false;
          console.log(`Successfully joined a Room: ${room}`);

          const videoChatWindow = document.getElementById('my-video-chat-window');

          createLocalVideoTrack().then(track => {
              videoChatWindow.appendChild(track.attach());
          });

          room.on('participantConnected', participant => {
            console.log(`A remote Participant connected: ${participant}`);
          });
          // Handle existing participants
          room.participants.forEach(handleParticipant);

          // Handle participants when they connect
          room.on('participantConnected', handleParticipant);

          window.addEventListener('beforeunload', () => room.disconnect());
        });
      });
    },
   }
}
</script>


<style>
.remote_video_container {
  left: 0;
  margin: 0;
  max-width: 100%;
  height: 100%;
  overflow: hidden;
  z-index: -1;
  position: absolute;
}
#localTrack video {
  width: 100px !important;
  background-repeat: no-repeat;
  height: 100px;
  position: absolute;
  z-index: 2;
}
.spacing {
  padding: 20px;
  width: 100%;
}
.Video {
  padding: 4px;
  color: rgb(3, 11, 19);
}
.col-md-10 {
  background-color: lightgray;
  height: auto;
}
</style>
