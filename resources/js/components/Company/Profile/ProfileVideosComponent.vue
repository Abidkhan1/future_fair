<template>
  <div class="container">
     <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Company Videos</h3>
      </div>
      <form class="form-horizontal" action="#" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" v-bind:value="csrf">
        <div class="card-body">
              <div class="row mt-5">

                <div class="col-md-8">
                  <div class="form-group">
                    <label>Youtube video link:</label>

                    <div class="input-group my-colorpicker2">
                      <input type="url" class="form-control" v-model:value="link">

                      <div class="input-group-append">
                        <button class="btn btn-success btn-sm input-group-text" type="button" name="button" :disabled="link.length == 0" @click="videoUpload">+</button>
                      </div>
                    </div>
                  </div>
                </div>
            </div>

            <div class="row px-2 my-2">
                <div class="card mx-3" v-for="(item,index) in uploadVideos" :key="index" style="width: 23rem; background-color:#e3dede;">
                  <div class="card-body">
                    <iframe width="320" height="240"
                    :src="item.url">
                    </iframe>
                  </div>
                  <div class="card-footer">
                    <button type="button" class="btn btn-danger mx-auto d-block" @click.prevent="removeVideo(index)" name="button">Remove</button>
                  </div>
                </div>
            </div>
        </div>
          <!-- /.card-body -->
         <div class="card-footer">
          <button type="button" class="btn btn-info" @click="saveVideos">Save</button>
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
        name: "comp-upload-videos",
        data(){
            return {
              name:'',
              details:'',
              banner:'',
              logo:'',
              url:'',
              link:'',
              display_name:'',
              creation_date:'',
              total_employees:'',
              files:[],
              videos:[],
              uploadVideos:[],
              errors:[],
              base_url:APP_URL,
            }
        },
        mounted() {
          console.log('hello');
            axios.get(APP_URL+`get_videos`).then(res=>{
              console.log('response :',res.data);
              this.videos = res.data.videos;
              this.fixData();
            }).catch(error=>{
                this.errors = error.response.data.errors;
                console.log(error);
            })
        },
        methods:{
          fixData(){
            this.videos.forEach((item, i) => {
              const obj = {
                  'url':item.name,
              }
              this.uploadVideos.push(obj);
            });
          },//fixData

          removeVideo(index){
            this.uploadVideos.splice(index,1);
          },//removeVideo(index)

          videoUpload(){
            var ret = this.link.replace('https://youtu.be/','');
            console.log('Link:',ret);
            const obj = {
                'url':'https://www.youtube.com/embed/'+ret,
            }
            this.link = ''
            this.uploadVideos.push(obj);
          },//videoUpload

          saveVideos(){
            axios.post(APP_URL+'upload_videos',{
              videos:this.uploadVideos
            })
            .then(response=>{
              console.log('res:',response.data);
              Swal.fire(
                'Good job!',
                'Videos Uploaded Successfully!',
                'success')

                let url = this.base_url+'comp_videos';
                setTimeout(function(){ window.location.href = url; }, 1500);

            }).catch(err=>{
              console.log('err:',err);
            })
          }//saveVideos

        }
    }
</script>
