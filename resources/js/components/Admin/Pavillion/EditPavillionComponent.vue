<template>
  <div class="container">
     <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Edit Pavillion</h3>
      </div>
      <form class="form-horizontal">
        <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group ml-2">
                    <label>Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Name" v-model:value="name">
                    <span v-if="errors.name" style="color:red;">{{errors.name[0]}}</span>
                    <span v-if="not_unique_combination" style="color:red;">Same name Pavillion Already exist in this Event</span>
                  </div>
                  <!-- /.form-group -->
                  <div class="form-group">
                      <label>Event</label>
                      <select class="form-control" style="width: 100%;" v-model="event_id" :disabled="events.length == 0">
                      <option v-for="event in events" :value="event.id" :key="event.id">{{event.name}}</option>
                      </select>
                      <span v-if="errors.event_id" style="color:red;">{{errors.event_id[0]}}</span>
                      <span v-if="events.length == 0" style="color:red;">Must create Event before creating Pavillion</span>
                  </div>
                </div>
                <!-- /.col -->
              </div>

             </div>
          <!-- /.card-body -->
         <div class="card-footer">
          <button type="button" class="btn btn-info" @click.prevent="updatePavillion">Save</button>

          <a type="button" :href="base_url+'pavillions'" class="btn btn-danger float-right">Cancel</a>

         </div>
          <!-- /.card-footer -->
        </form>
       </div>
    </div>
</template>

<script>
    import Swal from 'sweetalert2'
    export default {
        props:['id'],
        name: "edit-pavillion",
        data(){
            return {
              name:'',
              event_id:'',
              not_unique_combination:false,
              events:[],
              errors:[],
              base_url:APP_URL,
            }
        },
        mounted() {
            axios.get(APP_URL+`pavillions/${this.id}`).then(res=>{
              console.log('response :',res.data);
                this.name = res.data.pavillion.name;
                this.event_id = res.data.pavillion.event_id;
                this.events = res.data.events;
            }).catch(error=>{
                this.errors = error.response.data.errors;
                console.log(error);
            })
        },
        methods:{
            updatePavillion(){
                axios.put(APP_URL+'pavillions/'+this.id,{
                  name:this.name,
                  event_id:this.event_id,

                }).then(res=>{
                  if (res.data.status) {
                    Swal.fire(
                      'Good job!',
                      'Pavillion updated Successfully!',
                      'success'
                    )
                    this.name = '';
                    this.event_id = '';

                    let url = this.base_url+'pavillions';
                    setTimeout(function(){ window.location.href = url; }, 1500);
                  }else {
                    this.not_unique_combination = true
                  }

                }).catch(error=>{
                    this.errors = error.response.data.errors;
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!, Fill required fields',
                      })
                    console.log(error);
                })
            }
        }
    }
</script>
