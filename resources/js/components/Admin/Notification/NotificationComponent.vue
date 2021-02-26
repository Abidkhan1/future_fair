<template>
  <div class="container">
     <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Public  Notification</h3>
      </div>
      <form class="form-horizontal">
        <input type="hidden" name="_token" v-bind:value="csrf">
        <div class="card-body">

          <div class="form-group row px-5">
            <label for="title" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
              <input type="text" name="title" class="form-control" :value="title">
            </div>
          </div>
          <div class="form-group row px-5">
            <label for="title" class="col-sm-2 col-form-label">Message</label>
            <div class="col-sm-10">
              <textarea class="form-control" name="description" rows="8" cols="80" :value="message"></textarea>
            </div>
          </div>
        </div>
          <!-- /.card-body -->
         <div class="card-footer">
          <button type="button" class="btn btn-info" @click="sendNotification">Send</button>

          <a type="button" :href="base_url+'home'" class="btn btn-danger float-right">Cancel</a>

         </div>
          <!-- /.card-footer -->
        </form>
       </div>
    </div>
</template>

<script>
    import Swal from 'sweetalert2'
    export default {
        props:['csrf'],
        name: "notifications",
        data(){
            return {
              title:'',
              message:'',
              errors:[],
              base_url:APP_URL,
            }
        },
        mounted() {
          console.log('hello notification');
        },
        methods:{
          sendNotification(){
            axios.post(APP_URL+`send_notification`,{
              'title' : this.title,
              'message' : this.message,
            })
            .then(response=>{
              console.log('response:',response.data);
              Swal.fire('Good job!','Notification Sent Successfully!','success');
              this.title = '';
              this.message = '';
            })
            .catch(error=>{
              console.log('Error:',error);
            })
          }
        }
    }
</script>
