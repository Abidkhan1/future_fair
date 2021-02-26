<template>
    <div class="container">
     <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Register Event</h3>
      </div>
          <!-- /.card-header -->
          <!-- form start -->
      <form class="form-horizontal" method="POST" enctype="multipart/form-data" :action="base_url+'register_event'">
        <input type="hidden" name="_token" v-bind:value="csrf">
        <input type="hidden" name="event_id" :value="id">
        <div class="card-body" v-show="step === 1">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                  <label>Slot</label>
                  <select class="form-control" style="width: 100%;" v-model="slot_id" :disabled="slots.length == 0" name="slot_id">
                  <option value="" disabled>Select Slot</option>
                  <option v-for="slot in slots" :value="slot.id" :key="slot.id">{{slot.name}}</option>
                  </select>
                  <span v-if="errors.slot_id" style="color:red;">{{errors.slot_id[0]}}</span>
              </div>
            </div>
            <div class="col-md-6">
                <div class="">
                    <img src="/virtual_expo/public/images/pavillion.PNG" style="height: 100%; width: 100%; object-fit: contain">
                </div>
            </div>
          </div>
         </div>
        <div class="card-body" v-show="step === 2">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label>Template</label>
                    <select class="form-control" style="width: 100%;" v-model="template_id" name="template_id" :disabled="slots.length == 0">
                    <option value="" disabled>Select Template</option>
                    <option v-for="template in templates" :value="template.id" :key="template.id">{{template.name}}</option>
                    </select>
                    <span v-if="errors.template_id" style="color:red;">{{errors.template_id[0]}}</span>
                </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                      <label>Staff</label>
                      <select class="form-control" style="width: 100%;" v-model="staff_id" name="staff_id" :disabled="staffs.length == 0">
                      <option value="" disabled>Select Staff</option>
                      <option v-for="staff in staffs" :value="staff.id" :key="staff.id">{{staff.name}}</option>
                      </select>
                      <span v-if="errors.staff_id" style="color:red;">{{errors.staff_id[0]}}</span>
                  </div>
              </div>

            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="">
                  <img src="/virtual_expo/public/images/pavillion.PNG" style="height: 100%; width: 100%; object-fit: contain">
                 </div>
               </div>
            </div>
         </div>
        <div class="card-body" v-show="step === 3">
            <div class="row">
              <div class="col-md-4">
                  <div class="form-group">
                      <label class="col-lg-8">Upload Video</label>
                      <input class="btn btn-primary"  type="file" name="video" accept="video/*" @change.prevent="videoUpload">
                      <span v-if="errors.slot_id" style="color:red;">{{errors.slot_id[0]}}</span>
                  </div>
              </div>
          </div>
          <hr>
            <div class="row">
              <div class="col-md-4">
                  <div class="form-group">
                      <label class="col-lg-8">Upload Documents</label>
                      <input class="btn btn-primary"  type="file" multiple name="images[]" @change="fileUpload">
                      <span v-if="errors.slot_id" style="color:red;">{{errors.slot_id[0]}}</span>
                  </div>
              </div>
          </div>

          <div class="row px-2">
              <div class="card mx-3" v-for="(item,index) in uploadDocuments" :key="index" style="width: 18rem;">

                <div class="card-body">
                  <img class="card-img-top" :src="item.url" alt="Card image cap" style="height: 300px; width: 100%; object-fit: contain">
                </div>
                <div class="card-footer">
                  <button type="button" class="btn btn-danger mx-auto d-block" @click.prevent="removeFile(index)" name="button">Remove</button>
                </div>
              </div>
          </div>
         </div>
          <!-- /.card-body -->
         <div class="card-footer" v-show="step!=3">
          <button type="button" :disabled="step===1" class="btn btn-danger" @click.prevent="previous">Previous</button>
          <button type="button" class="btn btn-success float-right" @click.prevent="next">Next</button>
         </div>

         <div class="card-footer" v-show="step===3">
          <button type="button" class="btn btn-danger" @click.prevent="previous">Previous</button>
          <a type="button" :href="base_url+'company_events'" class="btn btn-danger float-right">Cancel</a>
          <button type="submit" class="btn btn-success float-right mx-1">Register</button>
         </div>
          <!-- /.card-footer -->
        </form>
       </div>
    </div>
</template>

<script>
    import Swal from 'sweetalert2'
    export default {
        props:['id','csrf'],
        name: "register-event",
        data(){
            return {
                step:1,
                slot_id:'',
                staff_id:'',
                template_id:'',
                url:'',
                file:null,
                video:null,
                templates:[
                    {id:1, name:'Template 1'},
                    {id:2, name:'Template 2'}
                ],
                staffs:[
                    {id:1, name:'Staff 1'},
                    {id:2, name:'Staff 2'}
                ],
                slots:[
                    {id:1, name:'Slot_1'},
                    {id:2, name:'Slot_2'}
                ],
                files:[],
                uploadDocuments:[],
                errors:[],
                base_url:APP_URL,
            }
        },
        mounted() {
            axios.get(APP_URL+`event_detail/${this.id}`).then(res=>{
              console.log('response :',res.data);
                this.events = res.data.events;

            }).catch(error=>{
                this.errors = error.response.data.errors;
                console.log(error);
            })
        },
        methods:{
            videoUpload(event){
                console.log('Video',event.target.file);
                this.video = event.target.file;
            },//videoUpload

            fileUpload(event){
                const file = event.target.files[0];
                this.url = URL.createObjectURL(file);
                console.log('file Upload',event.target.files);
                this.files = event.target.files;
                console.log('files:',this.files);

                this.files = [...event.target.files];
                console.log('files:',this.files);

                this.files.forEach((item, i) => {
                        const path = URL.createObjectURL(item)
                        const obj = {
                            'name':item.name,
                            'url':path,
                            'type':item.type,
                        }
                        this.uploadDocuments.push(obj);
                });
            },//fileUpload
            removeFile(index){
                this.uploadDocuments.splice(index,1);
            },//next
            next(){
                this.step++;
                console.log('next');
            },//next
            previous(){
                this.step--;
                console.log('previous');
            },//previous
            registerEvent(){
                axios.post(APP_URL+'register_event',{
                    files:this.uploadDocuments,
                    video:this.video
                }).then(res=>{
                    Swal.fire(
                      'Good job!',
                      'Event added Successfully!',
                      'success'
                    )
                    this.name = '';
                    this.description = '';
                    this.start_date = '';
                    this.end_date = '';
                    this.fees = '';

                    let url = this.base_url+'events';
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
