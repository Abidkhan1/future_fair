<template>
  <div class="container">
     <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Company Documents</h3>
      </div>
      <form class="form-horizontal" :action="base_url+'comp_documents'" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" v-bind:value="csrf">
        <div class="card-body">
              <div class="row mt-5">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="col-lg-8">Upload Documents</label>
                        <input class="btn btn-primary"  type="file" multiple name="images[]" @change="fileUpload">
                    </div>
                </div>
            </div>

            <div class="row px-2 my-2">
                <div class="card mx-3" v-for="(item,index) in uploadDocuments" :key="index" style="width: 18rem;">
                  <div class="card-body">
                    <img class="card-img-top" :src="item.url" alt="Card image cap" style="height: 300px; width: 100%; object-fit: contain">
                  </div>
                  <div class="card-footer">
                    <button type="button" class="btn btn-danger mx-auto d-block" @click.prevent="removeDocument(index)" name="button">Remove</button>
                  </div>
                </div>
            </div>
        </div>
          <!-- /.card-body -->
         <div class="card-footer">
          <button type="submit" class="btn btn-info">Save</button>
          <!-- <button type="button" @click.prevent="updateProfile" class="btn btn-info">Save</button> -->

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
              details:'',
              banner:'',
              logo:'',
              url:'',
              display_name:'',
              creation_date:'',
              total_employees:'',
              files:[],
              documents:[],
              uploadDocuments:[],
              errors:[],
              base_url:APP_URL,
            }
        },
        mounted() {
          console.log('hello');
            axios.get(APP_URL+`get_documents`).then(res=>{
              console.log('response :',res.data);
              this.documents = res.data.documents;
              this.fixData();
            }).catch(error=>{
                this.errors = error.response.data.errors;
                console.log(error);
            })
        },
        methods:{
          removeDocument(index){
              axios.post(APP_URL+'remove_document',{
                'document' : this.uploadDocuments[index]
              }).then(res => {
                console.log('res:',res.data);
                this.uploadDocuments.splice(index,1);
              })
              .catch(err => {
                console.log('error:',err);
              })


          },//removeDocument(index)

          fixData(){
            console.log('documents:',this.documents);
            this.documents.forEach((item, i) => {
              console.log('path:',item);
              const path = this.base_url+'/'+item.name;
              const obj = {
                  'name':item.name,
                  'url':path,
                  'type':item.type,
              }
              this.uploadDocuments.push(obj);
            });
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
                      this.uploadDocuments.push(obj);
              });
          },//fileUpload

          updateProfile(){
              let formData = new FormData();
              formData.append('images', this.uploadDocuments);

              axios.post(APP_URL+'comp_documents',{
                'documents' : this.uploadDocuments,
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
