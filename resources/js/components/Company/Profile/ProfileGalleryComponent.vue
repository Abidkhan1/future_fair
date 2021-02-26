<template>
  <div class="container">
     <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Company Gallery</h3>

      </div>
      <form class="form-horizontal" :action="base_url+'gallery'" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" v-bind:value="csrf">
        <div class="card-body">
          <div class="text-right">
            <button class="btn btn-sm float-right" type="button" name="button"
            :class="(!add_new)?'btn-success':'btn-danger'" @click="add_new = !add_new">{{(!add_new)? '+ ADD NEW':'X CLOSE'}}</button>

            <button type="submit" v-if="add_new" class="mx-2 btn btn-sm btn-info">Save</button>

          </div>
            <template v-if="add_new">
              <div class="row mt-2 ml-5">
                  <div class="col-md-2 centered">
                    <label class="">Title</label>
                  </div>
                  <div class="col-md-8">
                    <input class="form-control"  type="text" name="title"        v-model:value="title">
                  </div>
              </div>
              <div class="row my-4 ml-5">
                  <div class="col-md-2 centered">
                    <label class="">Upload Image</label>
                  </div>
                  <div class="col-md-8">
                    <input class="btn btn-primary"  type="file" name="image"  @change="imageUpload">
                  </div>
              </div>
              <div class="row">
                <div class="col-md-4">

                </div>
                <div class="col-md-4">
                  <div class="card"
                       v-if="image_path">
                    <div class="card-header">
                      <h4>{{title}}</h4>
                    </div>
                    <div class="card-body">
                      <img class="card-img-top" :src="image_path" alt="Card image cap" style="height: 250px; width: 100%; object-fit: contain">
                    </div>
                  </div>
                </div>
                <div class="col-md-4">

                </div>
              </div>
              <hr>
            </template>




            <div class="row px-2 my-2">
                <div class="card mx-3" v-for="(item,index) in uploadImages" :key="index" style="width: 18rem;">
                  <div class="card-header">
                    <h4>{{item.title}}</h4>
                  </div>
                  <div class="card-body">
                    <img class="card-img-top" :src="item.url" alt="Card image cap" style="height: 250px; width: 100%; object-fit: contain">
                  </div>
                  <div class="card-footer">
                    <button type="button" class="btn btn-danger mx-auto d-block" @click.prevent="removeDocument(index)" name="button">Remove</button>
                  </div>
                </div>
            </div>
        </div>
          <!-- /.card-body -->
         <div class="card-footer">
          <!-- <button type="submit" class="btn btn-info">Save</button> -->
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
        name: "comp-gallery",
        data(){
            return {
              title:'',
              url:'',
              add_new:false,
              image_path:false,
              documents:[],
              uploadImages:[],
              errors:[],
              base_url:APP_URL,
            }
        },
        mounted() {
          console.log('hello');
            axios.get(APP_URL+`gallery/${this.id}`).then(res=>{
              console.log('response :',res.data);
              this.documents = res.data.images;
              this.fixData();
            }).catch(error=>{
                this.errors = error.response.data.errors;
                console.log(error);
            })
        },
        methods:{
          removeDocument(index){
              axios.post(APP_URL+'remove_document',{
                'document' : this.uploadImages[index]
              }).then(res => {
                console.log('res:',res.data);
                this.uploadImages.splice(index,1);
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
                  'title':item.title,
              }
              this.uploadImages.push(obj);
            });
          },//fixData

          imageUpload(event){
              const file = event.target.files[0];
              this.image_path = URL.createObjectURL(file);
              //
              // this.files = event.target.files;
              // this.files = [...event.target.files];
              // this.files.forEach((item, i) => {
              //         const path = URL.createObjectURL(item)
              //         const obj = {
              //             'name':item.name,
              //             'url':path,
              //             'type':item.type,
              //         }
              //         this.uploadImages.push(obj);
              // });
          },//imageUpload

          updateProfile(){
              let formData = new FormData();
              formData.append('images', this.uploadImages);

              axios.post(APP_URL+'comp_documents',{
                'documents' : this.uploadImages,
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
