<template>
<div class="container">
 <div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">Video Call</h3>
  </div>
  <div class="card-body">
  <div id="video-chat-window" class="grid grid-flow-row grid-cols-2 grid-rows-2 gap-4"></div>
  </div>
    </div>
    </div>
</template>


<script>
export default {
    name: 'video-chat',
    data: function () {
        return {
            accessToken: '',
            base_url: APP_URL,
        }
    },
    methods : {
        getAccessToken : function () {

            const _this = this
            const axios = require('axios')

            // Request a new token
            axios.get(APP_URL+'api/access_token')
                .then(function (response) {
                    _this.accessToken = response.data
                })
                .catch(function (error) {
                    console.log(error);
                })
                .then(function () {
                    _this.connectToRoom()
                });
        },
        connectToRoom : function () {

            const handleParticipant = participant => {
                console.log('Participant connected', participant);

                let videoChatWindow = document.getElementById('video-chat-window');

                // Attach participants when they join
                participant.on('trackSubscribed', track => {
                    console.log('Track subscribed', track);
                    videoChatWindow.appendChild(track.attach());
                });

                // Detach participants when they leave
                participant.on('trackUnsubscribed', track => {
                    console.log('Track unsubscribed', track);
                    track.detach().forEach(mediaElement => {
                        mediaElement.remove();
                    });
                });
            }

            const { connect, createLocalVideoTrack } = require('twilio-video');

            connect(this.accessToken, { name:'cool room' }).then(room => {

                console.log(`Successfully joined a Room: ${room}`);

                const videoChatWindow = document.getElementById('video-chat-window');

                // Attach local tracks
                createLocalVideoTrack().then(track => {
                    videoChatWindow.appendChild(track.attach());
                });

                // Handle existing participants
                room.participants.forEach(handleParticipant);

                // Handle participants when they connect
                room.on('participantConnected', handleParticipant);

                // Handle page unload
                window.addEventListener('beforeunload', () => room.disconnect());

            }, error => {
                console.error(`Unable to connect to Room: ${error.message}`);
            });
        }
    },
    mounted : function () {
        console.log('Video room loading...')

        this.getAccessToken()
    }
}
</script>
