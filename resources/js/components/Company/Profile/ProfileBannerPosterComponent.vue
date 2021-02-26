<template>
  <div class="container">
     <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Company Banner, Logo & Poster</h3>
      </div>
      <form class="form-horizontal" :action="base_url+'comp_banner_poster'" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" v-bind:value="csrf">
        <div class="card-body">
              <div class="row my-5">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Logo</label>
                    <input class="btn btn-primary"  type="file" name="logo" @change="logoUpload">

                    <span v-if="errors.logo" style="color:red;">{{errors.logo[0]}}</span>
                  </div>
                  <div class="form-group" v-if="logo!== null">
                    <div class="card mx-3" style="width: 18rem;">
                      <div class="card-body">
                        <img class="card-img-top" :src="logo" alt="Card image cap" style="height: 300px; width: 100%; object-fit: contain">
                      </div>
                      <div class="card-footer">
                        <!-- <button type="button" class="btn btn-danger mx-auto d-block" name="button">Remove</button> -->
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label>Poster</label>
                    <input class="btn btn-primary"  type="file" name="poster" @change="posterUpload">

                    <span v-if="errors.poster" style="color:red;">{{errors.poster[0]}}</span>
                  </div>
                  <div class="form-group" v-if="poster">
                    <div class="card mx-3" style="width: 18rem;">
                      <div class="card-body">
                        <img class="card-img-top" :src="poster" alt="Card image cap" style="height: 300px; width: 100%; object-fit: contain">
                      </div>
                      <div class="card-footer">
                        <!-- <button type="button" class="btn btn-danger mx-auto d-block" name="button">Remove</button> -->
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Banner</label>
                    <input class="btn btn-primary" type="file" name="banner" @change="bannerUpload">
                    <span v-if="errors.banner" style="color:red;">{{errors.banner[0]}}</span>
                  </div>
                  <div class="form-group" v-if="banner">
                    <div class="card mx-3" style="width: 18rem;">
                      <div class="card-body">
                        <img class="card-img-top" :src="banner" alt="Card image cap" style="height: 300px; width: 100%; object-fit: contain">
                      </div>
                      <div class="card-footer">
                        <!-- <button type="button" class="btn btn-danger mx-auto d-block" name="button">Remove</button> -->
                      </div>
                    </div>
                  </div>
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
        name: "comp-banner-poster",
        data(){
            return {
              logo:null,
              banner:null,
              poster:null,
              url:'',
              errors:[],
              base_url:APP_URL,
            }
        },
        mounted() {
            axios.get(APP_URL+`get_banner_poster`).then(res=>{
                this.banner = (res.data.user.banner == null)? null : this.base_url+'/'+res.data.user.banner;
                this.logo = (res.data.user.logo == null)? null : this.base_url+'/'+res.data.user.logo;
                this.poster = (res.data.user.poster == null)? null : this.base_url+'/'+res.data.user.poster;
            }).catch(error=>{
                this.errors = error.response.data.errors;
                console.log(error);
            })
        },
        methods:{

          logoUpload(event){
            const file = event.target.files[0];
            this.logo = URL.createObjectURL(file);
          },//LogoUpload

          posterUpload(event){
            const file = event.target.files[0];
            this.poster = URL.createObjectURL(file);
          },//LogoUpload

          bannerUpload(event){
            const file = event.target.files[0];
            this.banner = URL.createObjectURL(file);
          },//BannerUpload

          updateProfile(){
              axios.put(APP_URL+'comp_banner_poster',{
                banner:this.banner,
                poster:this.poster,
              }).then(res=>{
                  console.log('response:',res.data);
                  Swal.fire(
                    'Good job!',
                    'Banner Poster updated Successfully!',
                    'success'
                  )
                  this.poster = '';
                  this.banner = '';
                  let url = this.base_url+'comp_banner_poster';
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
