<template>
  <div class="container">
     <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">End-user Dashboard Settings</h3>
      </div>
      <form class="form-horizontal" :action="base_url+'user_dashboard'" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" v-bind:value="csrf">
        <div class="card-body">

          <div class="form-group row px-5">
            <label for="title" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
              <input type="text" name="title" class="form-control" :value="dashboard_title">
            </div>
          </div>
          <div class="form-group row px-5">
            <label for="title" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
              <textarea class="form-control" name="description" rows="8" cols="80" :value="dashboard_description"></textarea>
            </div>
          </div>

          <div class="row mt-5 px-5">
            <div class="col-md-4">
              <div class="form-group">
                <template v-if="!add_logos">
                  <button type="button" class="btn btn-md btn-primary" @click="editLogos" name="button">Edit Logos</button>
                </template>

                <template v-else>
                  <label class="col-lg-8">Upload Logos</label>
                  <input class="btn btn-primary"  type="file" name="logos[]" multiple @change="fileUpload">
                  <span style="color:red;">Maximum 16 Logos allowed.</span>
                </template>
               </div>
             </div>
           </div>

            <div class="row px-2 my-2">
                <div class="card mx-3" v-for="(item,index) in uploadLogos" :key="index" style="width: 16rem;">
                  <div class="card-body">
                    <img class="card-img-top" :src="item.url" alt="Card image cap" style="height: 300px; width: 100%; object-fit: contain">
                  </div>
                  <!-- <div class="card-footer">

                  </div> -->
                </div>
            </div>
        </div>
          <!-- /.card-body -->
         <div class="card-footer">
          <button type="submit" class="btn btn-info">Save</button>

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
        props:['id','csrf'],
        name: "comp-profile",
        data(){
            return {
              name:'',
              add_logos:false,
              dashboard_title:'A Global Virtual Event Solution.',
              dashboard_description:'A Global Virtual Event Solution For Everyone. The COVID-19 coronavirus has challenged event planners to find education and networking opportunities that don’t rely on in-person events. Connect attendees from anywhere in the world through virtual, hybrid, and in-person events. Build Buzz and Engage with Prospects Through an Immersive Online Trade Show. Leverage a gorgeous virtual space for your biggest trade show yet, with customizable exhibitor booths, on-demand content, chat forums, and convenient online order placement.',
              details:'',
              banner:'',
              logo:'',
              url:'',
              display_name:'',
              creation_date:'',
              total_employees:'',
              files:[],
              data:[],
              documents:[],
              uploadLogos:[],
              errors:[],
              base_url:APP_URL,
            }
        },
        mounted() {
          console.log('hello');
            axios.get(APP_URL+`user_dashboard_data`).then(res=>{
              console.log('response :',res.data);
              this.data = res.data.data;
              this.fixData();
            }).catch(error=>{
                this.errors = error.response.data.errors;
                console.log(error);
            })
        },
        methods:{
          editLogos(){
            this.add_logos = true;
            this.uploadLogos=[];
          },//editLogos

          removeLogo(index){
              axios.post(APP_URL+'remove_document',{
                'document' : this.uploadLogos[index]
              }).then(res => {
                console.log('res:',res.data);
                this.uploadLogos.splice(index,1);
              })
              .catch(err => {
                console.log('error:',err);
              })
          },//removeLogo(index)

          fixData(){
            console.log('data:',this.data);
            this.data.forEach((item, i) => {
              console.log(i+':',item);
              switch (item.name) {
                case 'dashboard_title':
                  this.dashboard_title = item.value;
                  break;
                case 'dashboard_description':
                  this.dashboard_description = item.value;
                  break;
                case 'dashboard_logo'+(i-2):
                  const path = this.base_url+'/'+item.value;
                  const obj = {
                      'name':item.name,
                      'url':path,
                      'type':item.value,
                  }
                  this.uploadLogos.push(obj);
                  break;
              }


            });
            console.log('uploadLogos:',this.uploadLogos);
          },//fixData

          fileUpload(event){
              const file = event.target.files[0];
              this.url = URL.createObjectURL(file);
              this.files = event.target.files;
              this.files = [...event.target.files];
              this.files.forEach((item, i) => {
                      const path = URL.createObjectURL(item)
                      const obj = {
                          'name':item.name,
                          'url':path,
                          'type':item.type,
                      }
                      this.uploadLogos.push(obj);
              });
          },//fileUpload

          updateProfile(){
              let formData = new FormData();
              formData.append('images', this.uploadLogos);

              axios.post(APP_URL+'comp_documents',{
                'documents' : this.uploadLogos,
              },
              {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
              }).then(res=>{
                  console.log('response:',res.data);
                  Swal.fire(
                    'Good job!',
                    'Event updated Successfully!',
                    'success'
                  )

                  let url = this.base_url+'events';
                  // setTimeout(function(){ window.location.href = url; }, 1500);

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
