<template>
  <div class="container">
     <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Company Videos</h3>
      </div>
      <form class="form-horizontal" :action="base_url+'upload_videos'" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" v-bind:value="csrf">
        <div class="card-body">
              <div class="row mt-5">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="col-lg-8">Upload Videos</label>
                        <input class="btn btn-primary"  type="file" multiple name="videos[]" accept="video/*" @change="fileUpload">
                    </div>
                </div>
            </div>

            https://youtu.be/YiSQ_db-Dcw?list=RDYiSQ_db-Dcw
            
            <iframe width="727" height="409" src="https://www.youtube.com/embed/YiSQ_db-Dcw?list=RDYiSQ_db-Dcw" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>


            <div class="row px-2 my-2">
                <div class="card mx-3" v-for="(item,index) in uploadVideos" :key="index" style="width: 23rem;">
                  <div class="card-body">
                    <video :src="item.url" loop="true" controls="true">
            					Your browser doesn't support the video tag
            				</video>

                    <!-- <video width="320" height="240" controls>
                      <source :src="item.url" type='video/mp4; codecs="avc1.4D401E, mp4a.40.2"'>
                      Your browser does not support the video tag.
                    </video> -->
                  </div>
                  <div class="card-footer">
                    <button type="button" class="btn btn-danger mx-auto d-block" @click.prevent="removeVideo(index)" name="button">Remove</button>
                  </div>
                </div>
            </div>
        </div>
          <!-- /.card-body -->
         <div class="card-footer">
          <button type="submit" class="btn btn-info">Save</button>
          <a type="button" :href="base_url+'/home'" class="btn btn-danger float-right">Cancel</a>
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
          removeVideo(index){
              axios.post(APP_URL+'remove_video',{
                'video' : this.uploadVideos[index]
              }).then(res => {
                console.log('res:',res.data);
                this.uploadVideos.splice(index,1);
              })
              .catch(err => {
                console.log('error:',err);
              })
          },//removeVideo(index)

          fixData(){
            console.log('videos:',this.videos);
            this.videos.forEach((item, i) => {
              console.log('path:',item);
              const path = this.base_url+item.name;
              const obj = {
                  'name':item.name,
                  'url':path,
                  'type':item.type,
              }
              this.uploadVideos.push(obj);
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
                      this.uploadVideos.push(obj);
              });
          },//fileUpload

        }
    }
</script>
