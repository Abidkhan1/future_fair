<template>
  <div class="container">
     <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Register Event</h3>
      </div>
      <form class="form-horizontal">
        <div class="card-body">
          <div class="row">
            <div class="col">
              <div class="form-group">
                  <label>Event</label>
                  <select class="form-control" style="width: 100%;" v-model="event_id" :disabled="events.length == 0" @change="eventChanged">
                  <option value="" disabled>Select Event</option>
                  <option v-for="event in events" :value="event.id" :key="event.id">{{event.name}}</option>
                  </select>
                  <span v-if="errors.event_id" style="color:red;">{{errors.event_id[0]}}</span>
                  <span v-if="already_registered" style="color:red;">This Company is already registered for this Event</span>
                  <span v-if="events.length == 0" style="color:red;">Must create Event before register</span>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                  <label>Pavillion</label>
                  <select class="form-control" style="width: 100%;" v-model="pavillion" :disabled="pavillions.length == 0" @change="pavillionChanged">
                  <option value="" disabled>Select Pavillion</option>
                  <option v-for="pavillion in pavillions" :value="pavillion" :key="pavillion.id">{{pavillion.name}}</option>
                  </select>
                  <span v-if="errors.pavillion_id" style="color:red;">{{errors.pavillion_id[0]}}</span>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                  <label>Slot</label>
                  <select class="form-control" style="width: 100%;" v-model="slot_id" :disabled="slots.length == 0"@change="slotChanged">
                  <option value="" disabled>Select Slot</option>
                  <option v-for="(slot,index) in slots" :value="index" :key="index">{{slot}}</option>
                  </select>
                  <span v-if="no_slots" style="color:red;">No Vaccant Slot in selected Pavillion</span>
                  <span v-if="errors.slot_id" style="color:red;">{{errors.slot_id[0]}}</span>


              </div>
            </div>
          </div>
             </div>
          <!-- /.card-body -->
         <div class="card-footer">
          <button type="button" class="btn btn-info" @click.prevent="registerEvent">Save</button>

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
        props:['company_id'],
        name: "register-event",
        data(){
            return {
              name:'',
              slot_id:'',
              no_slots:false,
              already_registered:false,
              event_id:'',
              pavillion:'',
              pavillion_id:'',
              slots:[],
              events:[],
              pavillions:[],
              errors:[],
              base_url:APP_URL,
            }
        },
        mounted() {
            axios.get(APP_URL+`events_list`).then(res=>{
                this.events = res.data.events;
            }).catch(error=>{
                this.errors = error.response.data.errors;
                console.log(error);
            })
        },
        methods:{
          eventChanged(){
            this.pavillions = [];
            this.slots = [];
            this.slot_id='';
            axios.get(APP_URL+`event_pavillions/${this.event_id}/company/${this.company_id}`).then(res=>{
              if (res.data.status) {
                this.pavillions = res.data.pavillions;
                this.already_registered = false;
              }else {
                this.already_registered = true;
              }
            }).catch(error=>{
                this.errors = error.response.data.errors;
                console.log(error);
            })
          },//eventChanged\

          pavillionChanged(){
            this.slots = [];
            this.slot_id='';
            if (! this.pavillion.remaining_slots.length == 0) {
              this.slots = JSON.parse(this.pavillion.remaining_slots);
              this.no_slots = false;
            }else {
              this.no_slots = true;
            }
            this.pavillion_id = this.pavillion.id;
          },//pavillionChanged

          slotChanged(){
            console.log('slot changed');
          },//slotChanged
            registerEvent(){
                axios.post(APP_URL+'register_event/',{
                  _token: csrfToken,
                  company_id:this.company_id,
                  pavillion_id:this.pavillion_id,
                  event_id:this.event_id,
                  slot_id:this.slot_id,
                  slot_name:this.slots[this.slot_id],
                }).then(res=>{
                    Swal.fire(
                      'Good job!',
                      'Slot updated Successfully!',
                      'success'
                    )
                    this.slot_id = '';
                    this.event_id = '';
                    this.pavillion_id = '';

                    let url = this.base_url+'pavillions';
                    setTimeout(function(){ window.location.href = url; }, 1500);

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
